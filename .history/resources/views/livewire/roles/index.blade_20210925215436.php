
<div class="">
    <div class="max-w-6xl py-2 mx-auto sm:px-6 lg:px-8">

    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    @this.on('showStatusMsg', (msg, color) => {
        show_banner(msg, color);
    });
});
</script>
