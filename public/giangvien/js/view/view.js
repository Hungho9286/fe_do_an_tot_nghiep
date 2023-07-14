function togglePostForm() {
  var postForm = document.getElementById("postForm");
  var toggleButton = document.getElementById("togglePostButton");

  if (postForm.style.display == "none") {
    postForm.style.display = "block";
    toggleButton.style.display = "none";
  } else {
    postForm.style.display = "none";
    toggleButton.style.display = "block";
  }
}
var thi2Inputs = document.querySelectorAll('[name="thi_2"]');
thi2Inputs.forEach(function (input) {
  input.addEventListener("input", checkTongKet2Input);
});
function checkTongKet2Input(event) {
  var thi2Input = event.target;
  var tongKet1Input = thi2Input.parentNode.previousElementSibling.querySelector('[name="tong_ket_1"]');
  var tongKet2Input = thi2Input.parentNode.nextElementSibling.querySelector('[name="tong_ket_2"]');
  var luuButton = thi2Input.parentNode.querySelector('.luudiem');

  if (thi2Input.value !== "" && tongKet1Input.value < 4) {
    tongKet2Input.removeAttribute("readonly");
    luuButton.style.display = "inline-block";
  } else {
    tongKet2Input.setAttribute("readonly", "readonly");

    luuButton.style.display = "none";
  }
}



var thi1Inputs = document.querySelectorAll('[name="thi_1"]');
thi1Inputs.forEach(function (input) {
  input.addEventListener("input", checkThi2Input);
});
function checkThi2Input(event) {
  var tongket1Input = event.target;
  var thi2Input = tongket1Input.parentNode.nextElementSibling.querySelector('[name="thi_2"]');
  if (tongket1Input.value == "") {
    thi2Input.setAttribute("readonly", "readonly");
    thi2Input.value = "";
  }
  else{
    if (tongket1Input.value < 5) {
        thi2Input.removeAttribute("readonly");

      } else {
        thi2Input.setAttribute("readonly", "readonly");
        thi2Input.value = "";
      }
  }

}


function NhapDiem(button) {
  var row = button.parentNode.parentNode;
  var savebtn = row.querySelector('button:nth-child(2)');
  var cancelbtn = row.querySelector('button:nth-child(3)');
  var inputs = row.querySelectorAll('input[type="number"]');
  console.log(inputs);
  button.style.display = 'none';
  savebtn.style.display = '';
  cancelbtn.style.display = '';
  inputs.forEach(function (input) {
    input.readOnly = !input.readOnly;
  });

  // Gọi hàm kiểm tra
  inputs.forEach(function (input) {
    if (input.name == "tong_ket_1") {
      checkThi2Input({ target: input });
    } else if (input.name === "thi_2") {
      checkTongKet2Input({ target: input });
    }
  });
}

function isNumber(value) {
  return /^-?\d+(\.\d+)?\s*$/.test(value);
}
function LuuDiem(button) {
  var row = button.parentNode.parentNode;
  var inputs = row.querySelectorAll('input[type="number"]');
  var editButton = row.querySelector('button:first-child');
  var cancelButton = row.querySelector('button:nth-child(3)');


  inputs.forEach(function (input) {
    input.readOnly = true;
  });
  button.style.display = 'none';
  editButton.style.display = '';
  cancelButton.style.display = 'none';
  inputs.style.display = "block"
  Swal.fire('Thêm điểm thành công');

}

function HuyThemDiem(button) {
  var row = button.parentNode.parentNode;
  var inputs = row.querySelectorAll('input[type="number"]');
  var editButton = row.querySelector('button:first-child');
  var saveButton = row.querySelector('button:nth-child(2)');

  inputs.forEach(function (input) {
    input.readOnly = true;
  });

  button.style.display = 'none';
  editButton.style.display = '';
  saveButton.style.display = 'none';
}

$("#form_post").submit(function (e) {

  //stop submitting the form to see the disabled button effect
  e.preventDefault(e);

  return true;

});

// var inputField = document.getElementById('tieu_de_post');
// var textareaField = document.getElementById('summernote_post');
// var submitButton = document.getElementById('btn-dang-thong-bao');

// submitButton.disabled = true; // Mặc định là true

// inputField.addEventListener('input', handleInputChange);
// textareaField.addEventListener('input', handleInputChange);

// function handleInputChange() {
//   var inputText = inputField.value.trim();


//   if (inputText !== '' )


//   if (inputText !== '')

//    {
//     submitButton.disabled = false;
//   } else {
//     submitButton.disabled = true;
//   }
// }


var checkboxList = document.getElementById('checkboxList');
var checkboxes = checkboxList.getElementsByClassName('checkbox-item');
var selectAllCheckbox = checkboxes[0];
var lastCheckboxisChecked = checkboxes[checkboxes.length - 1];
var totalCheckbox = checkboxes.length;

// Mặc định, chọn tất cả các checkbox
for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].checked = true;
}
checkboxList.addEventListener('change', function (event) {

  var clickedCheckbox = event.target;

  if (clickedCheckbox === selectAllCheckbox) {
    var isChecked = clickedCheckbox.checked;
    for (var i = 1; i < checkboxes.length; i++) {
      checkboxes[i].checked = isChecked;
    }
  } else {
    var isAllChecked = true;
    for (var i = 1; i < checkboxes.length; i++) {
      if (!checkboxes[i].checked) {
        isAllChecked = false;
        break;
      }
    }
    selectAllCheckbox.checked = isAllChecked;
  }
  // // Kiểm tra xem có ít nhất một checkbox được chọn hay không
  // var isAtLeastOneChecked = false;
  // for (var i = 1; i < checkboxes.length; i++) {
  //   if (checkboxes[i].checked) {
  //     isAtLeastOneChecked = true;
  //     lastCheckboxisChecked = checkboxes[i];
  //     break;
  //   }
  // }
  //  // Kiểm tra xem có ít nhất một checkbox được chọn hay không
  // if (!isAtLeastOneChecked ) {
  //   lastCheckboxisChecked.checked = true;
  // }
  // let checkAllCheckBox = false ;
  // for(var i = 0; i<checkboxes.length;i++)
  // {
  //   if(checkboxes[i].checked)
  //   {
  //     checkAllCheckBox = true;
  //   }
  // }
  // if(selectAllCheckbox.checked==false && checkAllCheckBox==false  )
  // {
  //   checkboxes[1].checked = true;

  // }




});








