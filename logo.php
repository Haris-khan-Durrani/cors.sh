<title>Create Your Own Logo</title>
<link rel="stylesheet" href="https://logo.netxsites.com/tailwind-net.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdn.tailwindcss.com"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include 'db.php';
$companyName=$_GET['search_term'];
$refc=$_GET['refc'];
$contactName=$_GET['contactName'];
$phone=$_GET['phone'];
$lid=$_GET['lid'];
// Escape the single quote in the company name
$escapedCompanyName = str_replace("'", "''", $companyName);
$r="select * from userdomain where companyname='$escapedCompanyName'";
//var_dump($r);
$qu=mysqli_query($con,$r);
foreach($qu as $t){
$cnm=$t['companyname'];
$dom=$t['domain'];
}


//get logo information
$rl="select * from userlogo where companyname='$escapedCompanyName'";
//var_dump($r);
$qul=mysqli_query($con,$rl);
foreach($qul as $tl){
$clogo=$tl['companyname'];
}


if($cnm!="" && $clogo==""){
//if this domain is already registered so show this error

        ?>
     <style>
.o-main,header,footer,form{
    display:none !important
}
    .tw-flex h2{
        display: none;

    }
    .tw-flex p{
        display: none;

    }
    .tw-flex .tw-pt-6{
        display: none;

    }
    figure + div {
  display: none !important;
}
.tw-hidden {
  display: none !important;
}
.tw-col-span-12.md\:tw-col-span-10 {
  width: 100% !important;
  grid-column: span 12;
}
main > div > div:nth-child(2) {
    display: none !important;
}
.tw-mt-28{
    margin-top:0px !important
}
.mybuton{
    display: block;
    width: 100%;
    padding:5px;
    background-color:black;
    color:white;
    text-align:center
}
.wallahtest{
    color:red;
}
</style>
<script>



</script>
<?php
$nam=urlencode($_GET['name']);
$key=urlencode($_GET['key']);
$Colors=urlencode($_GET['Colors']);
$FilterByTags=urlencode($_GET['FilterByTags']);
$slogan=urlencode($_GET['slogan']);
$LogoStyle=$_GET['LogoStyle'];
$gli="https://www.brandcrowd.com/maker/logos/page1?Text=$nam&TextChanged=&IsFromRootPage=true&SearchText=$key&KeywordChanged=true&LogoStyle=$LogoStyle&FontStyles=&Colors=$Colors&FilterByTags=$FilterByTags&slogan=$slogan";
//$html=file_get_contents($gli);


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://proxy.cors.sh/$gli",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "x-cors-api-key: live_31d2df14ad43f73d3af74608e2e46d2735fe2dd4049f5c8c617b0be86e277c5d",  'X-Requested-With:XMLHttpRequest'
  ],
]);

$response = curl_exec($curl);
//var_dump($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
  $html=$response;
}
//$html=$response;


//var_dump($gli);
// Load the HTML into DOMDocument
$doc = new DOMDocument();
libxml_use_internal_errors(true); // To handle any HTML5 parsing errors
$doc->loadHTML($html);
//var_dump($doc);
libxml_clear_errors();

// Remove divs immediately following figure tags
$figures = $doc->getElementsByTagName('figure');
foreach ($figures as $figure) {
    $nextSibling = $figure->nextSibling;
    while ($nextSibling && $nextSibling->nodeType == XML_TEXT_NODE) {
        $nextSibling = $nextSibling->nextSibling;
    }
    if ($nextSibling && $nextSibling->nodeName === 'div') {
        $nextSibling->parentNode->removeChild($nextSibling);
    }
}

// Add a script element to the head of the document
$head = $doc->getElementsByTagName('head')->item(0);
if ($head) {
    $script = $doc->createElement('script', '
    document.addEventListener("DOMContentLoaded", function() {
        const pictures = document.querySelectorAll("figure");
        pictures.forEach(picture => {
        
            const imgElement = picture.querySelector("img");
            const imgSrc = imgElement.getAttribute("src");
            
            // Function to shorten the URL
            function shortenUrl(longUrl, callback) {
                fetch("https://short.crmsoftware.ae/shorten/"+encodeURIComponent(longUrl))
                    .then(response => response.json())
                    .then(data => {
                        if (data.shortUrl) {
                            callback("https://short.crmsoftware.ae/" + data.shortUrl);
                        } else {
                            console.error("Shortening URL failed");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }
            
            const button = document.createElement("button");
            button.innerText = "Finalize this Logo (T & C) applied";
            
            button.onclick = function() {
            let timerInterval;
Swal.fire({
  title: "Auto close alert!",
  html: "I Generate Your Logo in <b></b> milliseconds.",
  timer: 5000,
  allowOutsideClick: false,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading();
    const timer = Swal.getPopup().querySelector("b");
    timerInterval = setInterval(() => {
      timer.textContent = `${Swal.getTimerLeft()}`;
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval);
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log("I was closed by the timer");
  }
});
                // Shorten the image URL and then navigate
                shortenUrl(imgSrc, function(shortenedUrl) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const domi = urlParams.get("domain");
                    const search_term = urlParams.get("search_term");
                    const refc = urlParams.get("refc");
                    const phone = urlParams.get("phone");
                    const lid = urlParams.get("lid");
                    const contactName = urlParams.get("contactName");
                    
                    
                   $.ajax({
    url: "https://api.netxsites.com/client/createlogo.php",
    type: "GET",
    data: {
        logo: shortenedUrl,
        domain: domi,
        search_term: search_term,
        refc: refc,
        phone: phone,
        lid: lid,
        contactName: contactName
    },
    success: function(response) {
        // Handle success response here
       // console.log("Success: ", response);
         // Show SweetAlert notification
    // swal({
    //     title: "Thank You!",
       
    //     text: "Your logo has been sent successfully. to your email",
    //     icon: "success",
    //     button: "OK",
    // }).then(() => {
    //     // Redirect to Thanks.php
    //     window.location.href = "Thanks.php";
    // });
Swal.fire({
  title: "Good job!",
  text: "Your logo has been sent successfully to your email",
  icon: "success",
    allowOutsideClick: false,
}).then(() => {
  location.reload();
});

       
       
    },
    error: function(xhr, status, error) {
        // Handle error response here
        console.error("Error: ", error);
    }
});
 
                    
                    
                   
                });
            };
            button.classList.add("mybuton"); 
            
            picture.appendChild(button);
        });
    });
');
    $script->setAttribute('type', 'text/javascript');
    $head->appendChild($script);
    
}

// Save the modified HTML
$modifiedHtml = $doc->saveHTML();


//var_dump($modifiedHtml);

echo $modifiedHtml;
?>
<script>

jQuery(document).ready(function(){
    
   // jQuery(".tw-flex h2").remove();
     jQuery(".tw-flex h2").parent().remove();
        jQuery(".tw-flex p").remove();
            jQuery("ol").remove();
        jQuery(".tw-flex .tw-pt-6").remove();
 //       jQuery(".tw-col-span-12 .tw-flex").remove();
 var t=jQuery("figure img").attr("src");
jQuery("figure a").attr("href","#");
//jQuery("title").text("AI Logo Maker By Haris Khan");
    
jQuery("body .tw-container").prepend(`

 <div class="text-center mb-2">
      <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">Create Your Own Logo By Just One Click</h1>
      <h3 class="text-2xl text-center pb-2">Your Selected Domain: <?php echo $dom;?></h3>
    </div>

<form style="display:block !important" method="get" >
    <div class="grid gap-2 p-3 bg-white tw-shadow lg:grid-cols-5 md:grid-cols-2 sm:grid-cols-2 rounded">
        <div>
        
            <input type="text" value="<?php echo $_GET['name']; ?>" id="companyname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name/ Company Name/ Brand Name" name="name" required />
        </div>
        <div>
        
            <input type="text" id="key" value="<?php echo $_GET['key']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keyword/Your Business Nature" name="key" required />
        </div>
        <div>
            <input type="text" id="slogan" name="slogan" value="<?php echo $_GET['slogan']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Logo Slogan" required />
        </div>  
        <div>
            <select id="FilterByTags" name="FilterByTags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
   
   <option value="Tag wordmark|corporate|emblem|mascot|abstract|vintage|classic" selected>All Tags</option>
    <option value="Tag wordmark">Tag Wordmark</option>
    <option value="corporate">Corporate</option>
    <option value="emblem">Emblem</option>
    <option value="mascot">Mascot</option>
    <option value="abstract">Abstract</option>
    <option value="vintage">Vintage</option>
    <option value="classic">Classic</option>
    
    
  </select>
             </div>
              <div style="display:none">
            <select id="LogoStyle" name="LogoStyle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
   
   <option value="0" selected>All Type</option>
    <option value="1">Type 1</option>
    <option value="2">Type 2</option>
    <option value="3">Type 3</option>
 
    
    
  </select>
             </div>
        <div style="display:none">
          
            <input  type="text" id="Colors" value="<?php echo $_GET['Colors']; ?>" name="Colors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Brand Colors" />
        </div>
     <div>
     
     <input type="hidden" name="domain" value="<?php echo $dom; ?>">
          <input type="hidden" name="search_term" value="<?php echo $companyName; ?>">
               <input type="hidden" name="refc" value="<?php echo $refc; ?>">
                    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                                <input type="hidden" name="lid" value="<?php echo $lid; ?>">
                                            <input type="hidden" name="contactName" value="<?php echo $contactName; ?>">
     
     
     <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create My Logo</button>
     </div>
    </div>
    
</form>
`);

});

</script>
        <?php

}
else if($cnm!="" && $clogo!=""){
//if this domain is already registered so show this error

        ?>
        <div class="container text-center   ">
            <div class="col m-3 termss p-3">
                <img src="./assests/ex.png" style="margin:0px auto">
            <h2 class="terms">Your Domain & Logo Is Already Registered With Us</h2>
            <h3>Kindly Check your email</h3>
        
            </div></div>
        <?php

}
else{
    
    echo "There might be an issue please contact <a href='mailto:it@ebmsbusiness.com'>it@ebmsbusiness.com</a><a href='tel:+971562559270'> +971 56 255 9270</a>";
}



?>
<script type="text/javascript">
    // Remove the current page from the browser's history
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    // Add an entry to the history to disable back button
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.history.pushState(null, "", window.location.href);
    };
</script>
