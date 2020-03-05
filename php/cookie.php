<style>
    #cookieBar {
        z-index: 255;
        width: 100%;
        position: sticky;
        bottom: 0px;
        left: 0px;
        background-color: #00792D;
        color: white;

        display: flex;
        justify-content: space-evenly;
        padding: 25px;
    }
    #cookieBar h2 {
        font-size: 2.25em;
        text-align: center;
    }

    #cookieBar button {
        background-color: inherit;
        border: 4px solid white;
        font-size: 1.25em;
        color: white;

        padding:10px 30px;
        border-radius: 50px;
        width: fit-content;
        align-self: center;
    }

    @media screen and (max-width: 850px) {
        #cookieBar {
            flex-direction: column;

        }
    }
</style>
<?php if (!isset($_COOKIE["acceptCookies"])) {?>
<div id="cookieBar">
    <h2> Wij maken gebruik van cookies </h2>
    <button onclick="setCookie('acceptCookies', '1', 30)"> Accepteren </button>
</div>

<script>

    function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";

    let elem = document.getElementById('cookieBar');1
    elem.parentNode.removeChild(elem);
}

</script>
<?php } ?>
<!-- <button onclick="document.cookie = 'acceptCookies=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'">kill the cookie</button> -->