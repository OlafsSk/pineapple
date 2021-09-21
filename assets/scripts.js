const email = document.getElementById('email')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')
const checkbox = document.getElementById('checkbox')
const submit = document.getElementById('submit')
var emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


let emailInputText = ''
let isCheckboxChecked = false

document.getElementById('email').addEventListener('keyup', (e) => {

  e.preventDefault()

  emailInputText = e.target.value.trim()

  checkInputs(emailInputText, isCheckboxChecked);
});

document.getElementById('agree').addEventListener('click', (e) => {

  isCheckboxChecked = document.getElementById('checkbox').checked

  checkInputs(emailInputText, !isCheckboxChecked);
});

document.getElementById('submit').addEventListener('click', (e) => {

  const xhr = new XMLHttpRequest();
  xhr.open("POST", 'backend/routes/insert.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({
      email: emailInputText,
      checkbox: 'checked'
  }));

  document.getElementById('subscribe').style.display = 'none';

  document.getElementById('success').style.display = 'block';

});

function checkInputs(emailValue, isCheckboxChecked) {

  const validationRuleList = [
    {
      rule: !emailValue,
      message:'Email address is required'
    },
    {
      rule: !emailRegex.test(emailValue),
      message:'Please provide a valid e-mail address'
    },
    {
      rule: emailValue.substring(emailValue.length - 3) === '.co',
      message:'We are not accepting subscriptions from Colombia emails'
    },
    {
      rule: !isCheckboxChecked,
      message:'You must accept the terms and conditions'
    }
  ]

  let passedRules = 0

  validationRuleList.map((ruleSet) => {
    if (ruleSet.rule) {
      setError(ruleSet.message)
      return
    } else {
      passedRules++
    }
  })

  if (passedRules === validationRuleList.length) {
    setError('')
  }
}

function setError(err) {
  document.getElementById('err').innerHTML = err

  if (err) {
    document.getElementById('submit').style.display = 'none';
  } else {
    document.getElementById('submit').style.display = 'block';
  }

}
