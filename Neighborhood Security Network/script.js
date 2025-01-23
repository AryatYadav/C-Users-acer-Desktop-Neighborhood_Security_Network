const button=document.getElementById("get-location-button");
function gotLocation(position){
    let latitude=position.coords.latitude;
    let longitude =position.coords.longitude;
    console.log(latitude,longitude);
}
function failedToGet(){
    console.log("some issue");
}

button.addEventListener("click",async()=>{
    navigator.geolocation.getCurrentPosition(gotLocation,failedToGet);


}

);