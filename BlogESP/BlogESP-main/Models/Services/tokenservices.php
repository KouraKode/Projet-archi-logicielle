<?php

include_once "../Models/Database/daotoken.php";
function generateToken($id)
{
   $token = bin2hex(random_bytes(32));
   storeToken($id, $token);
   return $token;

}

function verifyToken($username, $strangeToken)
{
   $token = getToken($username)['token'];
   if ($token == $strangeToken) {
      return true;
   } else {
      return false;
   }
}