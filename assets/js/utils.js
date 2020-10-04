// Show Alert
ShowMessage = function(icon,title,position = 'top-end', url = '') {
   const Toast = Swal.mixin({
                  toast: true,
                  position: position,
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onClose: () => {
                     if (url != '') 
                      window.location.href = url;
                   }
                })

                Toast.fire({
                  icon: icon,
                  title: title
                })
}
//Goback Previous Page
GoBack = function() {
  window.history.back();
}

//Load
 LoadUrl = function(url) {
   window.location.href = url;
 }

//Download Files
// DownLoadFiles = function(image, folder, host_url) {

//         var a = $("<a>")
//           .attr("download", image)
//           .attr("href", host_url + folder+'/'+image)
//           .attr('target', '_blank')
//           .appendTo("body");

//       a[0].click();

//       a.remove();
//   }

//AXIOS POST
post = function(url,data) {
   return new Promise((resolve,reject) => {
        if (typeof data === 'object') {
          send = JSON.stringify(data);
        }
        if (data instanceof FormData == true) {
          send = data;  
        }
         axios.post(url,send).then(function(res) {
           resolve(res.data);
         })
         .catch(function(err) {
         error = JSON.stringify(reject({
             Error: 'Error Posting Data',
             status: 500,
             Info: err
          }));
        
        throw new Error(error);
     })
   })
}

//AXIOS GET
get = function(url) {
   return new Promise((resolve,reject) => {

     axios.get(url).then(function(res) {
          resolve(res.data);
      })
     .catch(function(err) {
       error = JSON.stringify(reject({
           Error: 'Error Getting Data',
           status: 500,
           Info: err
        }));
        
        throw new Error(error);
     })
   })
}

// //RENDER MENU
// var url = 'http://localhost:8080/CRPF_V2/';

// var xhttp = new XMLHttpRequest();
// var Menu = document.getElementById('Menus');
// console.log(Menu);
//  xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//         var data = JSON.parse(this.responseText);
//         console.log(data)
//         data.forEach(function(row, index) {

//           if (row.child != null) {

//              Menu.innerHTML += `<li id="li${row.RecID}">
//             <a href="#">
//                  <i class="metismenu-icon fa fa-angle-down"></i>
//                  <b>${row.Name}</b>
//              </a>
//              </li>
//            `;
          
//            row.child.forEach(function(res) {
//               var actvieMenu = window.location.href == url + res.Val ? 'mm-active' : '';
//                  document.querySelector('#Menus #li'+res.ParentID).innerHTML += `
//                    <ul class="mm-show"><li>
//                          <a href="${url}${res.Val}" class="${actvieMenu}">
//                              <i class="metismenu-icon"></i>
//                              ${res.Name}
//                          </a>
//                       </li>
//                     </ui>
//                  `;
//              })

//           }
//         });
//      }
//   };

// xhttp.open("GET", url+'Login/getmenus' , true);
// xhttp.send();
