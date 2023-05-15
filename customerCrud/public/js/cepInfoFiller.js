const VIACEP_API = 'https://viacep.com.br/ws/';
const format = '/json/';

function findCep (cepValue) {
  var cep = cepValue.replace(/\D/g, '');

  if (cep != "") {
    var validacep = /^[0-9]{8}$/;
      if(validacep.test(cep)) {
        document.getElementById('state').value=("...");
        document.getElementById('city').value=("...");
        document.getElementById('district').value=("...");
        document.getElementById('street').value=("...");

        var script = document.createElement('script');
        script.src = VIACEP_API + cep + format + '?callback=callback';
        document.body.appendChild(script);
      }
      else {
        clearAddressForm();
        alert("Formato de CEP inválido.");
      }
  } 
  else {clearAddressForm();}
};

function clearAddressForm () {
  document.getElementById('state').value=("");
  document.getElementById('city').value=("");
  document.getElementById('district').value=("");
  document.getElementById('street').value=("");
}

function callback (content) {
  if (!("erro" in content)) {
    document.getElementById('state').value=(content.uf);
    document.getElementById('city').value=(content.localidade);
    document.getElementById('district').value=(content.bairro);
    document.getElementById('street').value=(content.logradouro);
  } 
  else {
    clearAddressForm();
    alert("CEP não encontrado.");
  }
}
