<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Enchanted Library - Form Response</title>
    <link rel="stylesheet" type="text/css" href="enchanted-library.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Playfair+Display:wght@400;500;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    // create a file to store
    $file_name = "/afs/umbc.edu/users/n/s/nsubba1/pub/text-files/library-form2.txt";
    // Open or create library-form for reading and writing.
    $book_file = fopen($file_name, "a+") or die("Error - could not open file");
    // Check if the file exists, and print a message if it does not.
    if (!file_exists($file_name)) {
        print("The file $file_name does not exist");
    }

    ?>

    <div class="container">
        <?php
        // Retrieve and secure POST data from HTML injection
        if (flock($book_file, LOCK_EX)) {
            $BookName = htmlspecialchars($_POST["book-name"]);
            $authorName = htmlspecialchars($_POST["author-name"]);
            $genreType = htmlspecialchars($_POST["genre"]);
            $publishedYear = htmlspecialchars($_POST["published-year"]);

            // Check if all form fields are filled out.
            if (!empty($BookName) && !empty($authorName) && !empty($genreType) && !empty($publishedYear)) {
                $book_data = "Book Name: " . $BookName . "\n" .
                    "Author Name: " . $authorName  . "\n" .
                    "Genre: " . $genreType . "\n" .
                    "Published Year: " . $publishedYear . "\n\n";

                // Write the prepared data to the file.
                $write_to_file = fwrite($book_file, $book_data);
                fwrite($book_file, "\n");

                // Check if the write was successful.
                if ($write_to_file == false) {
                    print("<p>Writing to file failed.</p>");
                }
                // File lock and close the file.
                flock($book_file, LOCK_UN);
                fclose($book_file);
                ?>
                <h2>Success! The book has been added to the registry</h2>
                <div class="hr-container">
                    <hr class="hr-line">
                </div>
                <div class="form-content">
                    <!-- Display the entered book information -->
                    <h3>Your Book Information</h3>
                    <div class="hr-container">
                        <hr class="small-line-hr">
                    </div>
                    <p>
                        <strong>Book Name: </strong> <?php echo $BookName ?>
                    </p>
                    <p>
                        <strong>Author Name: </strong> <?php echo $authorName ?>
                    </p>
                    <p>
                        <strong>Genre Type: </strong> <?php echo $genreType ?>
                    </p>
                    <p>
                        <strong>Book Published Year: </strong> <?php echo $publishedYear ?>
                    </p>
                </div>
                    <div class="hr-container">
                        <hr class="small-line-hr">
                    </div>
                <h3>All Book Registry</h3>
                    <div class="hr-container">
                        <hr class="small-line-hr">
                    </div>
                <?php 
                // Read and display the contents of the entire file.
                    $content = file_get_contents($file_name);
                     $content_lines = explode("\n", $content);
                    foreach ($content_lines as $line) {
                        echo ($line) . "<br>";  
                    }
                ?>

                <!-- Provide a link to go back to the form page. -->
                <p class="go-back-link">
                    <a href="enchanted-library.html">Go Back to Form</a>
                </p>
                <?php

            } else {
                ?>
                <!-- Error message if not all form fields were filled out. -->
                <p class="retry-msg">
                    Incomplete form. Please enter the data here 
                    <a href="enchanted-library.html">previous page</a>, so we can write it to file!
                </p>
                <?php
            }
        } else {
            // Error message if the file lock was not successful.
            print("<p>Lock unsuccessful</p>");
        }
        ?>
    </div>
</body>
</html>
