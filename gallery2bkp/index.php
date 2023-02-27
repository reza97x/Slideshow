<html>
<body>
<head>
<style>
p {margin: 5%}
code {font-family: monospace}
body {background: beige}

/* customise these variables if required */

body{margin: 0}

:root {
  --image_height: 300px;
  --image_width: 30vw;
  
  --radius-sm: 1em;
  --radius-md: 1em;
  --radius-lg: 1em;

  --gallery_height: calc(var(--image_height) + 20px);
 	--gallery_width: 90vw;
  --gallery_background: transparent;
  --gallery_highlight: lightblue;

  --button_color: rgba(0,0,0,0.6);
  --button_width: 50px;
  --button_height: var(--button_width);

  --offset: calc((var(--gallery_width) - var(--image_width)) / 2);
  
  --spacebetween: 10px;
}

/* -------------- ATTENTION ---------------*/
/* DO NOT TOUCH ANYTHING BELOW THIS NOTICE */
/* --------------------------------------- */

/* CONTAINER */
.gallery {
	position: relative;
	width: var(--gallery_width);
	height: var(--gallery_height);
	margin: 20px auto;
	padding: 10px 0;
	background: var(--gallery_background);
        /* border-radius: 50%; */
        overflow: hidden;
}

/* IMAGE ROW */
.gallery .img_row {
	position: relative;
	height: var(--image_height);
  display: flex;
  justify-content: flex-start;
  transition: left 1s cubic-bezier(0.85, 0.03, 0.15, 0.96) 0s;
}
.gallery .img_row a {
	margin: 0;
	margin-right: var(--spacebetween);
}
.gallery .img_row a:last-child {
	margin-right: 0;
}
.gallery .img_row a img {
	width: var(--image_width);
	height: var(--image_height);
	object-fit: cover;
	border-radius: 50%;
}


/* NAVBAR ICONS */
.gallery nav.mid {
  display: flex;
  justify-content: center;
	width: 100%;
  padding: 10px 0;
}
.gallery nav.mid div {
  cursor: pointer;
	width: 10px;
	height: 10px;
	background: gray;
	margin-right: .5em;
  border-radius: 50%;
}
.gallery nav.mid div:last-child {
	margin-right: 0;
}
.gallery nav.mid div.current, .gallery nav.mid div:hover {
	background: var(--gallery_highlight);
}

/* PREV AND NEXT BUTTONS */
.gallery nav.prev, .gallery nav.next {
  position: absolute;
	top: 0;
	margin: 0;
  cursor: pointer;
  color: white;
  width: var(--button_width);
	height: var(--button_width);
  display: inline-block;
  font-size: 3em;
  font-weight: bold;
  line-height: var(--button_width);
  background: var(--button_color);
  border-radius: 50%;
  text-align: center;
}
.gallery nav.prev {
  top: calc(var(--gallery_height)/2 - var(--button_height)/2);
	left: 10px;
	/* left: calc(var(--offset)/2 - var(--button_width)/2); */
}
.gallery nav.next {
  top: calc(var(--gallery_height)/2 - var(--button_height)/2);
	right: 10px;
}
.gallery nav.prev:hover, .gallery nav.next:hover {
  color: var(--gallery_highlight);
}
</style>
</head>




<section class="gallery">

    <!-- 	row of images -->
    <div class="img_row"></div>

    <!-- 	circle buttons in middle below -->
    <nav class="mid"></nav>

    <!-- 	prev button(s) on left -->
    <nav class="prev">
      &lt;
    </nav>

    <!-- 	next button(s) on right -->
    <nav class="next">
      &gt;
    </nav>

  </section>
<style id="extra_style"></style>
<!-- put this just before the closing body tag but before any other scripts -->
<script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
<script>
/* customise this list of images if required */

const image_list = [
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 01.jpg", "https://www.google.com"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 02.jpg", "http://185.105.239.12/"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 03.jpg", "http://185.105.239.12/"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 04.jpg", ""],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 05.jpg", "https://www.google.com"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 06.jpg", "https://www.google.com"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 07.jpg", "https://www.google.com"],
  ["img/Wallpaper Mix 2017.04/Wallpaper Mix 2017.04 - 08.jpg", "https://www.google.com"],




];

const gallery = document.querySelector(".gallery");
const imgs = document.querySelector(".gallery .img_row");
const mids = document.querySelector(".gallery nav.mid");
const prev = document.querySelector(".gallery .prev");
const next = document.querySelector(".gallery .next");


// generate HTML from image list
for ( i in image_list ) {
  const img_num = parseInt(i) + 1;  // start from 1, not 0

  let img_tag = `<a href="${image_list[i][1]}"><img id="img_${img_num}" src="${image_list[i][0]}"></a>`;
  let midnav_tag = `<div id="get_${img_num}"></div>`;

  // initial images
  if (img_num == 2) {
    img_tag = `<a class="current" href="${image_list[i][1]}">
                <img id="img_${img_num}" src="${image_list[i][0]}"></a>`;
    midnav_tag = `<div id="get_${img_num}" class="current"></div>`;
  }

  imgs.insertAdjacentHTML("beforeend", img_tag);
  mids.insertAdjacentHTML("beforeend", midnav_tag);
}

// initial position
// manipulating CSSOM does not work via Codepen
// document.styleSheets[0].insertRule(`.gallery .img_row {left: calc(var(--offset) - (var(--image_width)*${1}) - (var(--spacebetween)*${1}))}`);
// const extra_style = document.getElementById('extra_style');
// const script_tag = document.querySelector('script');
//   script_tag.parentNode.insertBefore(extra_style, script_tag);
const extra_style = document.getElementById('extra_style');
extra_style.innerHTML = `.gallery .img_row {left: calc(var(--offset) - (var(--image_width)*${1}) - (var(--spacebetween)*${1}))}`;


// console.log("test");

const change = (dir) => {
  console.log("change triggered");
  // need local server
  // const st = document.styleSheets[0].cssRules;
  const originImg = document.querySelector("a.current");
  const originImgId = document.querySelector("a.current img").id;
  const originDiv = document.querySelector("div.current");
  const max = imgs.children.length;
  const o = parseInt(originImgId[4]);
  let c = 2;
  let mult = 1;
  if(dir == "next"){
    c = (o == max) ? 1 : (o + 1);
    mult = (c == 1) ? 0 : o;
  }
  if(dir == "prev"){
    c = (o == 1) ? max : (o - 1);
    mult = (c == max) ? (max - 1) : (c - 1);
  }
  originImg.classList.remove("current");
  originDiv.classList.remove("current");
  document.getElementById(`img_${c}`).parentElement.classList.add("current");
  document.getElementById(`get_${c}`).classList.add("current");
	// manipulating CSSOM does not work via Codepen
  // document.styleSheets[0].cssRules[0].style.left = `calc(var(--offset) - (var(--image_width)*${mult}) - (var(--spacebetween)*${mult}))`;
	extra_style.innerHTML = `.gallery .img_row {left: calc(var(--offset) - (var(--image_width)*${mult}) - (var(--spacebetween)*${mult}))}`;
}


// TOUCH FUNCTIONALITY
const hammertime = new Hammer(gallery);
hammertime.on("swipeleft", ()=> change("next"));
hammertime.on("swiperight", ()=> change("prev"));

// PREV / NEXT BUTTONS
prev.addEventListener("click", ()=> change("prev"));
next.addEventListener("click", ()=> change("next"));

// MIDDLE BUTTONS
for (let i=0; i< mids.children.length; i++) {
  mids.children[i].addEventListener("click", ()=> {
		// console.log("change triggered");
    const num = event.target.id[4];
    const max = imgs.children.length;
    const mult = (num == 0) ? max : num - 1;
    document.querySelector("a.current").classList.remove("current");
    document.querySelector("div.current").classList.remove("current");
    document.getElementById(`img_${num}`).parentElement.classList.add("current");
    document.getElementById(`get_${num}`).classList.add("current");
		// manipulating CSSOM does not work via Codepen
    // document.styleSheets[0].cssRules[0].style.left = `calc(var(--offset) - (var(--image_width)*${mult}) - (var(--spacebetween)*${mult}))`;
		extra_style.innerHTML = `.gallery .img_row {left: calc(var(--offset) - (var(--image_width)*${mult}) - (var(--spacebetween)*${mult}))}`;
  });
}
</script>
</body>
</html>
