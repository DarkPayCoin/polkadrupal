/**
 * @file
 * JavaScript file for the PolkaDrupal module.
 */

var alerted = false;

(function ($, Drupal, drupalSettings) {
    Drupal.behaviors.polkadrupal = {
      attach: function attach(context, settings) {

        function initWeb3Login() {
          
             dappex.web3Enable('polkadrupal').then(function(){
              if (!dappex.isWeb3Injected && alerted == false) {
                alert("You need a Web3 enabled browser to log in with Web3. The easiest solution is probably to install the Polkadot{js} extension.");
                alerted = true;
              } else {
               
                dappex.web3Accounts('polkadrupal').then( async (accounts) => {
                  showPicker(accounts);
                  document.querySelector("#web3messageSign").addEventListener('click', signMessage);
                } );
               }
              });
           
          }
        
          function showPicker(accounts) {
            let options = '';
            accounts.forEach(element => {
              options += '<option value="'+ element.address +'">'+ element.meta.name + ' - ' + element.address +'</option>';
            });
            document.querySelector("#web3login").style.display = 'none';
            let selector = document.querySelector("#web3accounts")
            selector.innerHTML = options;
            selector.style.display = "inline-block";
            document.querySelector("#web3messageSignDiv").style.display = 'block';
            
          }
          async function signMessage() {
          const address = $("#web3accounts").find(":selected").val();
          console.log(address);
          const message = document.querySelector("#messageToSign").value;
          const web3 = await dappex.web3FromAddress(address);
          const signer = web3.signer;
          const hexMessage = util.stringToHex(message);
          const signed = await signer.signRaw({
            type: 'bytes',
            data: hexMessage,
            address: address
            });
          }
         
          document.querySelector("#web3login").addEventListener('click', initWeb3Login);


      }
    };
  
  })(jQuery, Drupal, drupalSettings);
  