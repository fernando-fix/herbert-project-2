</main>
<footer></footer>
</body>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

    //menu
    if (localStorage.asideWidth) {
        document.querySelector("aside").classList.add(localStorage.asideWidth);
    } else {
        document.querySelector("aside").classList.add('aside-min-width');
    }
</script>

</html>