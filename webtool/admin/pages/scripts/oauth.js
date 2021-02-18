
$( document ).ready(function() {
  console.log( "ready!" );
  console.log("url",window.location.href)

  const decodeOne = decodeURI(window.location.href)

  const splitted = decodeOne.split("?")
  const splitOne = splitted[1]

  const splitTwo = splitOne.split("&")

  const AuthCode = splitTwo[1].replace("code=","")

  const splitAgain = splitTwo[0].split("=")[1]

  const lastSplit = splitAgain.split("|")
  const ProviderId = lastSplit[0]
  const ClientId = lastSplit[1]
  
  $.ajax({
    method: "POST",
    url: "http2://10.10.20.54:6889/api/connect/token",
    contentType: "application/json",
    data: JSON.stringify ({
      "AuthorizationCode": AuthCode,
      "ClientId": ClientId,
      "IdentityProvider": ProviderId,
      "TokenRequestType": "0",
      "RedirectUrl": "http://localhost:8888/automedsys-pace-admin/oauth"
    })
}).done(function( msg ) {
  console.log("dtaaa", msg)
  if(msg.ResponseData){
    localStorage.setItem(JSON.stringify(msg.ResponseData))

    // window.location.href = 'http://localhost:8888/automedsys-pace-admin/auth';

  }
});
});
