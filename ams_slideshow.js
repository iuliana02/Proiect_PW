var imgNumber = 0;
var images = ["photos/amsterdam1.jpg","photos/amsterdam2.jpg","photos/amsterdam3.jpg","photos/amsterdam4.jpg"];
var numberOfImg = images.length;
var timer = false;

function slide() {
  //schimb imaginea (la div i-am dat id-ul "imgSlideshow" ) cu urmatorul element din lista
  document.getElementById("imgSlideshow").src = images[imgNumber];

  var replay = document.getElementById("play_again").checked;
  if (imgNumber == numberOfImg-1 && replay == false){
    clearInterval(timer);
    var pause = document.getElementById("imgSlideShow");
    pause.value = "imgSlideShow";
    //clearTimeout(time);
  }

  //cresc pozitia curenta cu 1 inainte ca sa apara imaginea urmatoare si fac cu % lungimea pt cand ajunge la final
  imgNumber = (imgNumber + 1) % images.length;
}

function changeImages() {
  var userInput = document.getElementById("time");
  var newTime = userInput.options[userInput.selectedIndex].text;

  if (timer) { //pt pauza
    clearInterval(timer);
    timer = null;
  } else {
    timer = setInterval(slide, newTime);
  }
  return false;

}
