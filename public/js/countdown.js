//catching the submit button
var submitBtn = document.getElementById('submitBtn');
//creating 30 minutes
var delay = 1000*60*30;
//set the date we are counting down to
var countDownDate = Date.now() + delay ;

//update the count down every 1 second 
var x = setInterval(function(){

    //get today's date and time
    var now = new Date().getTime();

    //find the distance between now and the countdown time
    var distance = countDownDate - now ;

    //Time calculations for days,Hours,minutes and seconds
    var days = Math.floor(distance / (1000*60*60*24));
    var hours = Math.floor((distance % (1000*60*60*24)) / (1000*60*60));
    var minutes = Math.floor((distance % (1000*60*60)) / (1000*60));
    var seconds = Math.floor((distance % (1000*60)) / 1000);

    //display the result in the element with id="demo"
    document.getElementById("demo").innerHTML = "Time Limit : " + hours + ":" + minutes + ":" + seconds

    //if the count down is finished submit the form
    if(distance < 0){
        clearInterval(x);
        submitBtn.click();
        document.getElementById("demo").innerHTML = "Expired";
    }

}, 1000);