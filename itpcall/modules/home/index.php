<div id='central1'>
</div>
<script type="text/javascript">
function lastSpy() {
        var target = $('central1');
        if (!target) return false;
        new Ajax.PeriodicalUpdater(target,
        BASE_URL + 'monitor.php',
        {
                insertion: Insertion.top,
                method: 'post',
                frecuency: 0.1});
}

Event.observe(window, 'load', lastSpy, false);

</script>