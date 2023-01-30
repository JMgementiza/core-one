<?php
session_start();
require_once '../connection.php';


if (isset($_POST['register']))
    {
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $mname = mysqli_real_escape_string($con, $_POST['mname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $dateofbirth = mysqli_real_escape_string($con, $_POST['dateofbirth']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $blood_type = mysqli_real_escape_string($con, $_POST['blood_type']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);

        $query = "INSERT INTO patient (fname,mname,lname,dateofbirth,age,gender,blood_type,address,email,contact_no) VALUES 
            ('$fname','$mname','$lname','$dateofbirth','$age','$gender','$blood_type','$address','$email','$contact_no') ";
        $query_run = mysqli_query($con, $query);


            //Check if inputs are empty
        if (empty($fname) || empty($mname) || empty($lname) || empty($dateofbirth)|| empty($age)  || empty($gender) || empty($blood_type) || empty($address) || empty($email) || empty($contact_no)) {
                header("Location: ../patient-registration/register.php?registration=emptyfields"."&fname=".$fname."&mname=".$mname."&lname=".$lname."&age=".$age."&email=".$email."&contact=".$contact_no);
                exit();
            }
            //Check if characters are valid
            else if (!preg_match("/^[0-9]*$/", $age)) {
                header("Location: ../patient-registration/register.php?registration=invalidcharacters".$age);
                exit();
            }
            //Check if email is valid
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../patient-registration/register.php?registration=invalidemail".$email);
                    exit();
                }
            //Check if characters are valid 
            else if (!preg_match("/^[0-9]*$/", $contact_no)) {
                header("Location: ../patient-registration/register.php?registration=invalidcharacters".$contact_no);
                exit();
            } 
        
            else {
                header("Location: ../patient-registration/register.php?registration=success");
                exit();
                }
        
    }