<html>
<head>
<link rel="manifest" href="manifest.json">
	<title>Aplicacion con notificaciones</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
	<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
	<script>
		// Initialize Firebase
		var config = {
		apiKey: "AIzaSyDWTe9D_NJ2jRSoxaji9b1mejU2lGrMFbA",
		authDomain: "practica5-calvario.firebaseapp.com",
		databaseURL: "https://practica5-calvario.firebaseio.com",
		projectId: "practica5-calvario",
		storageBucket: "practica5-calvario.appspot.com",
		messagingSenderId: "699771789076"
		};
		firebase.initializeApp(config);
	</script>
</head>
<body>
<h1>App con notificaciones</h1>
<script>

	const messaging = firebase.messaging();
	// Add the public key generated from the console here.
	messaging.usePublicVapidKey("BDAdDlQYKM34wvLMa5QIK4JCbpOq2GZLL-6MESuKUzMyvHQlOVTThS8INEAi3xALxDhkVtszq-J-q-7zfQ4nsk4");

	messaging.requestPermission().then(function() {
  		console.log('Notification permission granted.');
  		// TODO(developer): Retrieve an Instance ID token for use with FCM.
  		// ...
	}).catch(function(err) {
  	console.log('Unable to get permission to notify.', err);
	});


function resetUI() {  
    // [START get_token]
    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken().then(function(currentToken) {
      if (currentToken) {  
        saveToken(currentToken);      
        console.log(currentToken);
        setTokenSentToServer(true);
      } else {
        console.log('No Instance ID token available. Request permission to generate one.');
        setTokenSentToServer(false);
      }
    }).catch(function(err) {
      console.log('An error occurred while retrieving token. ', err); 
      setTokenSentToServer(false);
    });
  }
  // [END get_token]
  function showToken(currentToken) {
    // Show token in console and UI.
    var tokenElement = document.querySelector('#token');
    tokenElement.textContent = currentToken;
  }

  function saveToken(currentToken){
    $.ajax({
    url:'action.php',
    method:'post',
    data: 'token=' + currentToken
  }).done(function(result){
  console.log();
  })
  }  
  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === 1;
  }  
  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
  }
  function showHideDiv(divId, show) {
    const div = document.querySelector('#' + divId);
    if (show) {
      div.style = 'display: visible';
    } else {
      div.style = 'display: none';
    }
  }
  function requestPermission() {
    console.log('Requesting permission...');
    // [START request_permission]
    messaging.requestPermission().then(function() {
      console.log('Notification permission granted.');
      // TODO(developer): Retrieve an Instance ID token for use with FCM.
      // [START_EXCLUDE]
      // In many cases once an app has been granted notification permission, it
      // should update its UI reflecting this.
      resetUI();
      // [END_EXCLUDE]
    }).catch(function(err) {
      console.log('Unable to get permission to notify.', err);
    });
    // [END request_permission]
  }
  function deleteToken() {
    // Delete Instance ID token.
    // [START delete_token]
    messaging.getToken().then(function(currentToken) {
      messaging.deleteToken(currentToken).then(function() {
        console.log('Token deleted.');
        setTokenSentToServer(false);
        // [START_EXCLUDE]
        // Once token is deleted update UI.
        resetUI();
        // [END_EXCLUDE]
      }).catch(function(err) {
        console.log('Unable to delete token. ', err);
      });
      // [END delete_token]
    }).catch(function(err) {
      console.log('Error retrieving Instance ID token. ', err);
      showToken('Error retrieving Instance ID token. ', err);
    });
  }
  // Add a message to the messages element.
  function appendMessage(payload) {
    const messagesElement = document.querySelector('#messages');
    const dataHeaderELement = document.createElement('h5');
    const dataElement = document.createElement('pre');
    dataElement.style = 'overflow-x:hidden;';
    dataHeaderELement.textContent = 'Received message:';
    dataElement.textContent = JSON.stringify(payload, null, 2);
    messagesElement.appendChild(dataHeaderELement);
    messagesElement.appendChild(dataElement);
  }

  function updateUIForPushPermissionRequired() {
    showHideDiv(tokenDivId, false);
    showHideDiv(permissionDivId, true);
  }
  resetUI();
	  
</script>
</body>
</html>

