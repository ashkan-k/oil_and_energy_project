function parseError(e, msg='خطا در دریافت اطلاعات') {
              let statusCode = e.status;
              if (statusCode === 404) {
                  createToast('error', 'صفحه یا مسیر مورد نظر یافت نشد. ممکن‌ است دسترسی لازم را نداشته باشید.');
              } else if (statusCode === 403) {
                  createToast('error', 'شما دسترسی به این آیتم را ندارید.');
              } else {
                  try {
                      let error = e.data['non_field_errors'][0];
                      if (error) {
                          createToast('error', error);
                      }
                  } catch (e) {
                      createToast('error', msg);
                  }
              }
          }
function createToast(type, text) {
            let bgColor = '';
            let header = '';
            if (type === 'error') {
              header = 'خطایی رخ داده';
              bgColor = '#e6294b';
            } else if (type === 'warning') {
              header = 'اخطار';s
              bgColor = "#ffb22b";
            } else {
              header = "موفقیت آمیز";
              bgColor = "#06d79c";
            }
            $.toast({
              heading: header,
              text: text,
              position: 'top',
              bgColor: bgColor,
              loaderBg: "rgb(13, 146, 108)",
              loader: true,
              hideAfter: 3000,
              stack: 3
            });
          }
function createSwal(type, text, title, showCancel = true, confirmText = 'بله،مطمئن‌ام', cancelText = "انصراف") {
    return Swal.fire({
      title: title,
      text: text,
      type: type,
      showCancelButton: showCancel,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: confirmText,
      cancelButtonText: cancelText
    })
}

function getCookie(name) {
    let cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
