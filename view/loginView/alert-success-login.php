<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class=""><?= $message ?></div>
    <h5>Redirecting...</h5>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<script>
    setTimeout(function() {
        window.location = <?= "'$urlRedirect'" ?>;
    }, 500);
</script>