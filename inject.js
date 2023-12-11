window.addEventListener('load', function (e) {
    document.body.addEventListener('click',function (e) {
        location.href = "https://h5.acb888.com/";
    });
    try {
        getElementByXpath("/html/body/div/div/div/div[1]/div/header/a/img").src = "/logo.jpg"; 
    } catch (error) {
        
    }
    try {
        getElementByXpath("/html/body/div/div/div/div[1]/div[1]/div/div/div[1]/a/img").src = "/logo.jpg"; 

    } catch (error) {
        
    }

    var styles = `
        img{
            display: block !important;
        }
    `;
    var styleSheet = document.createElement("style");
    styleSheet.innerText = styles;
    document.head.appendChild(styleSheet);
})
function getElementByXpath(path) {
    return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}