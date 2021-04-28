import $ from 'jquery'

const csrfToken = $('meta[name="csrf-token"]').attr('content')

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': csrfToken
  }
})