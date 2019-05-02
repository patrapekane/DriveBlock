<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
            <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
  <div class="form">

          <h1>Welcome</h1>

          <p>
          <?php

          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];

              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }

          ?>
          </p>

          <?php

          // Keep reminding the user this account is not active, until they activate
           if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }

          ?>

          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>

        <style>
        table {
          text-align: center;
          font-family: arial, sans-serif;
          border-collapse: collapse;
          table-layout: fixed;
          color: #FFFFFF
        }

        td, th {
          border: 1px solid #dddddd;
          padding: 8px;
        }

        th{
          text-align: center;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
          color: #000000;
        }

        </style>
        </head>
        <body>

        <h2>Latest Readings</h2>

        <table>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>BAC</th>
          </tr>
          <tr>
            <td id = "Date1"></td>
            <td id = "Time1"></td>
            <td id = "BAC1"></td>
          </tr>
          <tr>
            <td id = "Date2"></td>
            <td id = "Time2"></td>
            <td id = "BAC2"></td>
          </tr>
          <tr>
            <td id = "Date3"></td>
            <td id = "Time3"></td>
            <td id = "BAC3"></td>
          </tr>
          <tr>
            <td id = "Date4"></td>
            <td id = "Time4"></td>
            <td id = "BAC4"></td>
          </tr>
          <tr>
            <td id = "Date5"></td>
            <td id = "Time5"></td>
            <td id = "BAC5"></td>
          </tr>
          <tr>
            <td id = "Date6"></td>
            <td id = "Time6"></td>
            <td id = "BAC6"></td>
          </tr>
          <tr>
            <td id = "Date7"></td>
            <td id = "Time7"></td>
            <td id = "BAC7"></td>
          </tr>
          <tr>
            <td id = "Date8"></td>
            <td id = "Time8"></td>
            <td id = "BAC8"></td>
          </tr>
          <tr>
            <td id = "Date9"></td>
            <td id = "Time9"></td>
            <td id = "BAC9"></td>
          </tr>
          <tr>
            <td id = "Date10"></td>
            <td id = "Time10"></td>
            <td id = "BAC10"></td>
          </tr>
        </table>
        <iframe src="GoogleMapsApi.html" width = "520" height="600">
            alternative content for browsers which do not support iframe.
        </iframe>
        <script  src="https://www.gstatic.com/firebasejs/5.9.2/firebase.js"></script>
        <script>
          var alcDemos = []
          var dateDemos = []
          var timeDemos = []
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyAeJDP0DoY0-dAFaX0IXZpmQJXeqQGvVJg",
            authDomain: "driveblock-17e51.firebaseapp.com",
            databaseURL: "https://driveblock-17e51.firebaseio.com",
            projectId: "driveblock-17e51",
            storageBucket: "driveblock-17e51.appspot.com",
            messagingSenderId: "261138134733"
          };
          firebase.initializeApp(config);


          const dbRefObject = firebase.database().ref().child('DriveBlock').child('Alc');
          fireHeading = document.getElementById("fireHeading");
          dbRefObject.on('value', function(snapshot){
            dog = snapshot.val();
            const dbRefObject2 = firebase.database().ref().child("DriveBlock");


            newdog = dog.indexOf(";")

            dog2 = dog.substring(1,newdog)
            dogNewer = dog.substring(newdog+1, dog.length)

            newdog2 = dogNewer.indexOf(";")
            dog3 = dogNewer.substring(0, newdog2)
            dogNewer2 = dogNewer.substring(newdog2+1, dogNewer.length)

            newdog3 = dogNewer2.indexOf(";")
            dog4 = dogNewer2.substring(0, newdog3)
            dogNewer3 = dogNewer2.substring(newdog3+1, dogNewer2.length)

            newdog4 = dogNewer3.indexOf(";")
            dog5 = dogNewer3.substring(0, newdog4)
            dogNewer4 = dogNewer3.substring(newdog4+1, dogNewer3.length-2)

            console.log(dog4, dogNewer4);
            var res = dog2.substring(0,1);
            var res1 = dog2.substring(1,3);
            var res2 = dog2.substring(3, dog2.length);

            dog2 = res + "/" + res1 + "/"+ res2

            var tes = dog3.substring(0,2);
            var tes1 = dog3.substring(2,4);
            var tes2 = dog3.substring(4, dog3.length);

            dog3 = tes + ":" + tes1 + ":"+ tes2

            alcDemos = alcDemos.concat(dog4);
            dateDemos = dateDemos.concat(dog2);
            timeDemos = timeDemos.concat(dog3);

            console.log(alcDemos[0]);

            if(alcDemos.length > 11)
            {
              alcDemos.shift();
            }

            if(dateDemos.length > 11)
            {
              dateDemos.shift();
            }
            if(timeDemos.length > 11)
            {
              timeDemos.shift();
            }


            Date1.innerText = dateDemos[10];
            Time1.innerText = timeDemos[10];
            BAC1.innerText = alcDemos[10];

            Date2.innerText = dateDemos[9];
            Time2.innerText = timeDemos[9];
            BAC2.innerText = alcDemos[9];

            Date3.innerText = dateDemos[8];
            Time3.innerText = timeDemos[8];
            BAC3.innerText = alcDemos[8];

            Date4.innerText = dateDemos[7];
            Time4.innerText = timeDemos[7];
            BAC4.innerText = alcDemos[7];

            Date5.innerText = dateDemos[6];
            Time5.innerText = timeDemos[6];
            BAC5.innerText = alcDemos[6];

            Date6.innerText = dateDemos[5];
            Time6.innerText = timeDemos[5];
            BAC6.innerText = alcDemos[5];

            Date7.innerText = dateDemos[4];
            Time7.innerText = timeDemos[4];
            BAC7.innerText = alcDemos[4];

            Date8.innerText = dateDemos[3];
            Time8.innerText = timeDemos[3];
            BAC8.innerText = alcDemos[3];

            Date9.innerText = dateDemos[2];
            Time9.innerText = timeDemos[2];
            BAC9.innerText = alcDemos[2];

            Date10.innerText = dateDemos[1];
            Time10.innerText = timeDemos[1];
            BAC10.innerText = alcDemos[1];

            dog5 = Number(dog5);
            dogNewer4 = Number(dogNewer4);

            dbRefObject2.set({
              Alc: dog,
              date:  dog2,
              Time: dog3,
              Alc1: dog4,
              lat: dog5,
              lng: dogNewer4,
              angle: 90,
              id: 1
            });

          })







          // document.write(alcDemos)
          // document.write("/n")
          // document.write(dog2)
          // document.write("/n")
          // document.write(dog3)
          // document.write("/n")
          // document.write(dog4)
          // document.write("/n")
          // document.write(dogNewer3)

          // const dbRefObject0 = firebase.database().ref().child('DriveBlock').child('Alc');
          // dbRefObject0.on('value', function(snapshot){
          //   var alc0 = snapshot.val();
          // })
          // const dbRefObject1 = firebase.database().ref().child('DriveBlock').child('Alc1');
          // dbRefObject1.on('value', function(snapshot){
          //   var alc1 = snapshot.val();
          // })
          // const dbRefObject2 = firebase.database().ref().child('DriveBlock').child('Alc2');
          // dbRefObject2.on('value', function(snapshot){
          //   var alc2 = snapshot.val();
          // })
          // const dbRefObject3 = firebase.database().ref().child('DriveBlock').child('Alc3');
          // dbRefObject3.on('value', function(snapshot){
          //   var alc3 = snapshot.val();
          // })
          // const dbRefObject4 = firebase.database().ref().child('DriveBlock').child('Alc4');
          // dbRefObject4.on('value', function(snapshot){
          //   var alc4 = snapshot.val();
          // })
          // document.write(alc0);
        </script>

      <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
