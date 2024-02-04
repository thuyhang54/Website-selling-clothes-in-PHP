function toast({
    title = "",
    message = "",
    type = "info",
    duration = 3000,
  }) {
    const main = document.getElementById("toast");
    if (main) {
      const toast = document.createElement("div");
      //Auto remove toast
   const autoRemoveId = setTimeout(function(){
        main.removeChild(toast);
      }, duration  + 1000);

      //Remove toast when clicked
      toast.onclick = function(e) {
        // closest tim xem co class nay khong neu khong se tim dem the cha
        if (e.target.closest('.toast__close')){
            main.removeChild(toast);
            clearTimeout(autoRemoveId);
        }
      }
      const icons = {
        success: "fa-solid fa-circle-check",
        warning: "fa-solid fa-triangle-exclamation",
        danger: "fa-solid fa-circle-exclamation",
      };
      const icon = icons[type];
      const delay = ((duration)/1000).toFixed(2);
      toast.classList.add("toast", `toast--${type}`);
      toast.style.animation =` slideInleft ease 0.3s, fadeOut linear 1s ${delay}s forwards`;
      toast.innerHTML = `
            <div class="toast__icon"><i class="${icon}"></i></div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                <p class="toast-msg">${message} </p>
            </div>
            <div class="toast__close"><i class="fa-solid fa-xmark"></i></div>`;

      main.appendChild(toast);
      
      
    }
  }

  //Tạo 1 hàm chứa đối tượng gồm key/value cần thực hiện
//   toast({
//     // View
//     title: "Success",
//     message: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
//     // Xử lý
//     type: "success",
//     duration: 1000,
//   });

function  showSuccessToast (){
    toast({
    // view
    title: "Thành công ",
    message: "Bạn đã đăng ký tài khoản thành công",
    // xu ly
    type: "success",
    duration: 5000,
  })
};


function  showWarningToast(){
    toast({
    // view
    title: "Cảnh báo",
    message: "Có lỗi, vui lòng kiểm tra lại",
    // xu ly
    type: "warning",
    duration: 5000,
  })
};

function  showDangerToast(){
    toast({
    // view
    title: "Lỗi",
    message: "Có lỗi xảy ra, vui lòng liên hệ quản trị viên",
    // xu ly
    type: "danger",
    duration: 3000,
  })
};