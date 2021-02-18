$.get(getProvidersUrl(), function (data) {
  // let providerElem = document.getElementById("prov");
  // let b = {"HasResult":true,"ResponseData":[{"Id":"73DEE486-FB87-40BD-BE80-622EE40395F8","Name":"Google","Logo":"https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png","ClientId":"276590763171-5lvfsoql497spassdmbccjkaqhofr7lp.apps.googleusercontent.com","RedirectUrl":["https://pace.automedsys.net"," https://qa-pace.automedsys.net"," https://dev-pace.automedsys.net ","https://localhost"," https://localhost:8235"],"Scope":["openid","email","profile"],"GrantTypeAllowed":["authorization_code","refresh_token"],"ClientGrantUrls":[{"GrantType":"authorization_code","Url":"https://accounts.google.com/o/oauth2/v2/auth"},{"GrantType":"refresh_token","Url":"https://oauth2.googleapis.com/token"}]}],"Successful":true,"ResultType":1,"Message":null,"ValidationMessages":null}
  if (data.ResponseData.length > 0) {
    const { ResponseData } = data;
    for (let i in ResponseData) {
      let Name = ResponseData[i].Name;
      let Logo = ResponseData[i].Logo;
      let URL = ResponseData[i].ClientGrantUrls[0].Url;
      let genUrl = URL.replace("{redirect_uri}", getRedirectUrl());
      $("#prov")
        .append(`<a href='${genUrl}' type="submit" class="oauthbutton btn black">
        ${Name} <img src='${Logo}'  />
    </a>`);
    }
  }
});

function getRedirectUrl() {
  // generate url based on environment
  let url = window.location.href;
  let u = "";
  if (url.includes("dev-pace")) {
    u = "https://dev-pace.automedsys.net/oauth";
  } else if (url.includes("qa-pace")) {
    u = "https://qa-pace.automedsys.net/oauth";
  } else {
    u = "http://localhost:8888/automedsys-pace-admin/oauth";
  }
  return u;
}


function getProvidersUrl() {
  // generate url based on environment
  let url = window.location.href;
  let u = "";
  if (url.includes("dev-pace")) {
    u = "https://dev-api.automedsys.net/emrapi/v1/identity/providers";
  } else if (url.includes("qa-pace")) {
    u = "https://dev-api.automedsys.net/emrapi/v1/identity/providers";
  } else {
    u = "https://dev-api.automedsys.net/emrapi/v1/identity/providers";
  }
  return u;
}