// var inputField = document.getElementById('tieu_de_modal');
// var textareaField = document.getElementById('summernote_modal');
// var submitButton = document.getElementById('btn-luu-thay-doi-thong-bao');

// submitButton.disabled = true; // Mặc định là true

// inputField.addEventListener('input', handleInputChange);
// textareaField.addEventListener('input', handleInputChange);

// function handleInputChange() {
//   var inputText = inputField.value.trim();


//   if (inputText !== '' )
  
//    {
//     submitButton.disabled = false;
//   } else {
//     submitButton.disabled = true;
//   }
// }
var checkboxList_modal = document.getElementById('checkboxList_modal');
var checkboxes_modal = checkboxList_modal.getElementsByClassName('checkbox-item_modal');
var selectAllCheckbox_modal = checkboxes_modal[0];
var lastCheckboxisChecked_modal = checkboxes_modal[checkboxes_modal.length - 1];
// Mặc định, chọn tất cả các checkbox
for (var i = 0; i < checkboxes_modal.length; i++) {
  checkboxes_modal[i].checked = true;
}
checkboxList_modal.addEventListener('change', function(event) {
  
  var clickedCheckbox_modal = event.target;

  if (clickedCheckbox_modal === selectAllCheckbox_modal) {
    var isChecked_modal = clickedCheckbox_modal.checked;
    for (var i = 1; i < checkboxes_modal.length; i++) {
      checkboxes_modal[i].checked = isChecked_modal;
    }
  } else {
    var isAllChecked_modal = true;
    for (var i = 1; i < checkboxes_modal.length; i++) {
      if (!checkboxes_modal[i].checked) {
        isAllChecked_modal = false;
        break;
      }
    }
    selectAllCheckbox_modal.checked = isAllChecked_modal;
  }
    // Kiểm tra xem có ít nhất một checkbox được chọn hay không
    var isAtLeastOneChecked_modal = false;
    for (var i = 1; i < checkboxes_modal.length; i++) {
      if (checkboxes[i].checked) {
        isAtLeastOneChecked_modal = true;
        lastCheckboxisChecked_modal = checkboxes_modal[i];
        break;
      }
    }
     // Kiểm tra xem có ít nhất một checkbox được chọn hay không
    if (!isAtLeastOneChecked_modal ) {
      lastCheckboxisChecked_modal.checked = true;
    }
    let checkAllCheckBox_modal = false ;
    for(var i = 0; i<checkboxes_modal.length;i++)
    {
      if(checkboxes_modal[i].checked)
      {
        checkAllCheckBox_modal = true;
      }
    }
    if(selectAllCheckbox_modal.checked==false && checkAllCheckBox_modal==false )
    {
      checkboxes_modal[1].checked = true;
    }    
   
    
});
