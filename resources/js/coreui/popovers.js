/* global coreui */


document.querySelectorAll('[data-toggle="popover"]').forEach(element => {
  // eslint-disable-next-line no-new
  new coreui.Popover(element)
})

// $('[data-toggle="popover"]').popover()
// $('.popover-dismiss').popover({
//   trigger: 'focus'
// })
