from django.shortcuts import render, redirect
from usersManager.forms import LoginForm, UserForm
from zeep import Client


client = Client(wsdl='http://localhost:8080/admin-api?wsdl')


def authentication(request):
    if request.method == 'POST':
        form = LoginForm(request.POST)
        if form.is_valid():
            # call SOAP service here
            request.session['token'] = client.service.authenticate(username=form.cleaned_data['username'], 
            password=form.cleaned_data['password'])
            request.session['username'] = form.cleaned_data['username']
            if request.session['token']:
                print("User authenticated successfully")
                return redirect('home')
            else:
                print("User authentication failed")
                return render(request, 'login.html', {'form': form})
        else:
            print("User authentication failed")
            return render(request, 'login.html', {'form': form})
    else:
        form = LoginForm()
        return render(request, 'login.html', {'form': form})
    

def list(request):
    if isAuthenticaded(request):
        print(request.session['token'])
        # call SOAP service here
        users = client.service.getUsers(token=request.session['token'])
        # users = [
        #     {"username": "kourako1", "administrator": 1},
        #     {"username": "azprime", "administrator": 0},
        #     {"username": "soueid", "administrator": 1},
        #     {"username": "cellou", "administrator": 0},
        #     {"username": "aladji", "administrator": 0},
        # ]
        if users:
            return render(request, 'home.html', {'users': users})
        else:
            return render(request, 'home.html', {'users': []})


def create(request):
    if not isAuthenticaded(request):
        return redirect('login')
    else:
        if request.method == 'POST':
            form = UserForm(request.POST)
            if form.is_valid():
                # call SOAP service here
                isCreated = client.service.addUser(username=form.cleaned_data['username'], password=form.cleaned_data['password'], admin=form.cleaned_data['admin'], token=request.session['token'])
                if isCreated:
                    print("User created successfully")
                    return redirect('home')
                else:
                    print("User creation failed")
                    return render(request, 'create.html', {'form': form})      
            else:
                print("User creation failed")
                return render(request, 'create.html', {'form': form})
        else:
            form = UserForm()
            return render(request, 'create.html', {'form': form})


def update(request, username):
    if not isAuthenticaded(request):
        return redirect('login')
    else:
        if request.method == 'POST':
            user = {"username": request.POST.get('newUsername', None), "password": request.POST.get('password', None), "newState": request.POST.get('newState', None)}
            print(user)
            if request.POST.get('username', None) and request.POST.get('password', None): 
                # call SOAP service here
                isUpdated = client.service.modifyUser(username=request.POST.get('username', None), newUsername=request.POST.get('newUsername', None), password=request.POST.get('password', None), newState=request.POST.get('newState', 0), token=request.session['token'])
                if isUpdated:
                    print("User updated successfully")
                    return redirect('home')
                else:
                    print("User updating failed")
                    return render(request, 'update.html', {'user': user})
            else:
                print("User updating failed")
                return render(request, 'update.html', {'user': user})
        else:
            # Get user's infos by id
            user = client.service.getUser(username=username, token=request.session['token'])
            #user = {"id": 1, "username": "kourako1", "admin": 1}
            
            return render(request, 'update.html', {'user': user})


def delete(request, username):
    if not isAuthenticaded(request):
        return redirect('login')
    else:
        if username == request.session['username']:
            print("You can't delete your own account")
            return redirect('home')
        else:
            # call SOAP service here
            isDeleted = client.service.removeUser(username=username, token=request.session['token'])
            if isDeleted:
                print(f"User {username} deleted successfully")
                return redirect('home')
            else:
                print(f"User {username} deleted successfully")
                return redirect('home')


def isAuthenticaded(request):
    if 'token' in request.session:
        return True
    else:
        return False

def logout(request):
    request.session.flush()
    return redirect('login')

