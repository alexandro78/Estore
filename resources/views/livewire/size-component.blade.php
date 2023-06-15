

<script>
    let variableForLiveWire1 = 8;
    document.addEventListener('livewire:load', function() {
        Livewire.emit('dataReceived', variableForLiveWire1);
    });
</script>
