<?php
session_start();
include("_header.html");

if(isset($_SESSION["user"])){
    
} else{
    include("_sessionExpired.html");
}


include("_footer.html");