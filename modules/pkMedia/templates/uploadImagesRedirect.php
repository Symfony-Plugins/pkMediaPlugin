<script>
window.parent.location = <?php echo json_encode(url_for("pkMedia/editImages?" . http_build_query($parameters))) ?>
</script>
