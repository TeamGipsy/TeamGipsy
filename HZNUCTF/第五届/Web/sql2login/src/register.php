<?php
include "connect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>FLAG is sent after login~</title>
</head>

<body bgcolor="#FFFFFF">

<font size="5" color="#000000">
    <div style="text-align:center">

        <form name="mylogin" method="POST" action="registerrr.php">


            <div align="center">
                <table style="margin-top:50px;">
                    <tr>
                        <td style="text-align:right">
                            <font size="25" color="#000000">
                                <strong>Username:</strong></font>
                        </td>
                        <td style="text-align:left">
                            <style>
                                #username {
                                    width: 400px; /* 设置宽度为150像素 */
                                    height: 35px; /* 设置高度为50像素 */
                                }
                            </style>
                            <input name="username" id="username" type="text" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right">
                            <font size="25" color="#000000">
                                <strong>Password:</strong>
                            </font>
                        </td>
                        <td style="text-align:left">
                            <style>
                                #password {
                                    width: 400px; /* 设置宽度为150像素 */
                                    height: 35px; /* 设置高度为50像素 */
                                }
                            </style>
                            <input name="password" id="password" type="password" value=""/>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:right">
                            <font size="20" color="#000000">
                                <strong>Retype Password:</strong>
                            </font>
                        </td>
                        <td style="text-align:left">
                            <style>
                                #re_password {
                                    width: 400px; /* 设置宽度为150像素 */
                                    height: 35px; /* 设置高度为50像素 */
                                }
                            </style>
                            <input name="re_password" id="re_password" type="password" value=""/>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2" style="text-align:right">
                            <style>
                                #submit {
                                    width: 800px; /* 设置宽度为150像素 */
                                    height: 70px; /* 设置高度为50像素 */
                                }
                            </style>
                            <input name="submit" id="submit" type="submit" value="Register"/><br/><br/>
                        </td>
                    </tr>

                </table>
            </div>
        </form>
    </div>
</body>
</html>
