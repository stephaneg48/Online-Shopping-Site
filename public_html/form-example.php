<div id="container"></div>
<script>
    //this is a completely random example

    //let's create an array of words (why not?)
    var words = ["hello", "there", "hi", "howdy"];
    //get a reference to our "container"
    let container = document.getElementById("container");
    //let's do something every 1 second (1000 ms)
    setInterval(() => {
        //create a p tag
        let p = document.createElement("p");
        //add a random word as the text
        p.innerText = words[parseInt(Math.random() * words.length)];
        //don't forget to append it to the container/DOM otherwise this just sits in memory and won't show
        container.appendChild(p);
    }, 1000);
    //let's do something every 2.5 seconds
    setInterval(() => {
        //each interval we'll just delete the first child of the container
        //due to the timing we'll eventually get a long list that will never totally be empty (this is a slow memory hog so don't run it for a very long time)
        container.querySelector(":first-child").remove();
    }, 2500);
</script>