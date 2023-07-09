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

  
  
  function NhapDiem(button) {
 
   
    var row = button.parentNode.parentNode;
    var savebtn = row.querySelector('button:nth-child(2)');
    var cancelbtn = row.querySelector('button:nth-child(3)');
    var inputs = row.querySelectorAll('input[type="number"]');
    button.style.display = 'none';
    savebtn.style.display = '';
    cancelbtn.style.display = '';
    inputs.forEach(function(input) {
      input.readOnly = !input.readOnly;
     
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

   
    inputs.forEach(function(input) {
      input.readOnly = true;
    });
    button.style.display = 'none';
    editButton.style.display = '';
    cancelButton.style.display = 'none';
    inputs.style.display ="block"
    Swal.fire('Thêm điểm thành công');
  
  }
  
  function HuyThemDiem(button) {
    var row = button.parentNode.parentNode;
    var inputs = row.querySelectorAll('input[type="number"]');
    var editButton = row.querySelector('button:first-child');
    var saveButton = row.querySelector('button:nth-child(2)');
    
    inputs.forEach(function(input) {
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
checkboxList.addEventListener('change', function(event) {

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








