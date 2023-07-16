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




function isInputAllowed(tong_ket_1_value) {
  return tong_ket_1_value == "" || tong_ket_1_value < 5;
}



var thi1Inputs = document.querySelectorAll('[name="thi_1"]');
thi1Inputs.forEach(function (input) {
  input.addEventListener("input", checkThi2Input);
});
function checkThi2Input(event) {
  var thi1Input = event.target;
  var thi2Input = thi1Input.parentNode.nextElementSibling.querySelector('[name="thi_2"]');
  if (thi1Input.value == "") {
    thi2Input.setAttribute("readonly", "readonly");
    thi2Input.value = "";
  }
  if (thi1Input.value < 5) {
    thi2Input.removeAttribute("readonly");
  } else {
    thi2Input.setAttribute("readonly", "readonly");
    thi2Input.value = "";
  }
}




function NhapDiem(button) {
  var row = button.parentNode.parentNode;
  var savebtn = row.querySelector('button:nth-child(2)');
  var cancelbtn = row.querySelector('button:nth-child(3)');
  var inputs = row.querySelectorAll('input[type="number"]');




 var tong_ket_1_input = row.querySelector('input[name="tong_ket_1"]');


  // Kiểm tra giá trị của "tong_ket_1"
  var tong_ket_1_value = parseFloat(tong_ket_1_input.value);
  var allowInput = isInputAllowed(tong_ket_1_value);

  // Cho phép chỉnh sửa "thi_2" và "tong_ket_2" dựa trên kết quả của hàm isInputAllowed()
  inputs.forEach(function (input) {

    if (input.name == 'thi_2' || input.name == 'tong_ket_2') {
      input.readOnly = !allowInput;
      console.log(input.name);
      console.log(input.readOnly);
    } else {
      input.readOnly = false;
      console.log(input.readOnly);

    }
  });
  button.style.display = 'none';
  savebtn.style.display = '';
  cancelbtn.style.display = '';

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








