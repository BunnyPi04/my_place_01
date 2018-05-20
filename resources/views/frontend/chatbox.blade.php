<div class="chatbox container" id="chat">
    <div class="chat-name">
        <div class="click" onclick="myFunction()">
            <a href="#"><b>Chat box</b></a>
            <i class="fa fa-close"></i>
        </div>
        <div id="myDiv" style="display: none;">
            <div class="chat-content">
                <div class="friend">
                    <div class="avatar">
                        <img src="http://localhost:8000/images/Upload/admin.jpg">
                    </div>
                    <div class="friend-text">
                        <a>Sona:</a></br>
                        Only you can hear me, Summoner. What masterpiece shall we play today?
                    </div>
                </div>
                <div class="yours">
                    <div class="avatar">
                        <img src="http://localhost:8000/images/Upload/admin.jpg">
                    </div>
                    <div class="your-text">
                        I decide what the tide will bring
                    </div>
                </div>
                <div class="friend">
                    <div class="avatar">
                        <img src="http://localhost:8000/images/Upload/admin.jpg">
                    </div>
                    <div class="friend-text">
                        <a>Teemo:</a></br>
                        Captain teemo on duty!
                    </div>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" name="" placeholder="enter text here">
                <button class="btn btn-info"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
var numchat = $('.chat-name').length;
console.log(numchat);
function myFunction() {
    var x = document.getElementById("myDiv");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
