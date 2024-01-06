<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Enchanted Library - Form Response</title>
    <link rel="stylesheet" type="text/css" href="enchanted-library.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Playfair+Display:wght@400;500;900&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Container for the main content -->
    <div class="container">
        <p>
            <?php
            // Retrieve and secure POST data from HTML injection
                $firstName = htmlspecialchars($_POST["first-name"]);
                $lastName = htmlspecialchars($_POST["last-name"]);
                $streetName = htmlspecialchars($_POST["st-name"]);
                $cityName = htmlspecialchars($_POST["city-name"]);
                $stateName = htmlspecialchars($_POST["state-name"]);
                $zipCode = htmlspecialchars($_POST["zipcode"]);
                $empID = htmlspecialchars($_POST["emp-id"]);
        
                // Validate the format of the employee ID using a pattern
                if (preg_match("/^[A-Za-z]{4}\d{4}$/", $empID)) {
            ?>
        </p>
        <!-- Thank you message personalized with the first name -->
        <h2>Thank You for submitting the form, <?php echo $firstName; ?> </h2>
        <div class="hr-container">
            <hr class="hr-line">
        </div>
        <div class="form-content">
            <!-- Displaying the submitted employee information -->
            <h3>Employee Information</h3>
            <div class="hr-container">
                <hr class="small-line-hr">
            </div>
            <p>
                <strong>First Name: </strong> <?php echo $firstName; ?> 
            </p>
            <p>
                <strong>Last Name: </strong> <?php echo $lastName; ?> 
            </p>
            <p>
                <strong>Street Name: </strong> <?php echo $streetName; ?> 
            </p>
            <p>
                <strong>City: </strong> <?php echo $cityName; ?> 
            </p>
            <p>
                <strong>State: </strong> <?php echo $stateName; ?> 
            </p>
            <p>
                <strong>Zipcode: </strong> <?php echo $zipCode; ?> 
            </p>
            <p>
                <strong>Employee ID: </strong> <?php echo $empID; ?> 
            </p>
        </div>
        <!-- Link to return to the previous form -->
        <p class="go-back-link">
            <a href="employee.html">Go Back to Form</a>
        </p>
        <?php
            } else {
                // Error message if employee ID is not in the correct format
                echo "Employee ID was incorrect <br />";
        ?>
        <!-- Instructions for the user to correct the Employee ID input -->
        Please go back to <a href="employee.html">form</a> to re-enter the Employee ID. Make sure it follows this format: 4 letters followed by 4 digits.
        <?php
            }
        ?>
        </p>
    </div>
</body>

</html>
