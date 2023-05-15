<?php

function create_toast($type, $title, $body)
{
    if ($type == "success") {
        $color = $type;
    }
    if ($type == "error") {
        $color = "danger";
    }
    if ($type == "normal") {
        $color = "dark";
    }

    return "<div class='toast-container text-white position-fixed bottom-0 end-0 p-3'>
    <div id='liveToast' class='toast bg-$color' role='alert' aria-live='assertive' aria-atomic='true'>
    <div class='toast-header'>
    <strong class='me-auto'>$title</strong>
    <small>now</small>
    <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
    </div>
    <div class='toast-body'>
    $body
    </div>
    </div>
    </div>
    <script>
const toastLiveExample = document.getElementById('liveToast');
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
toastBootstrap.show();
  </script>";
}
