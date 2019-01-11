    <footer>
    <hr />
    <p class="navbar navbar-expand-lg navbar-light bg-light">Copyright
	<?
    	echo COMPANY_NAME;
		echo ' 2018 to ', date('Y');
	?></p>
    </footer>
</div><? //end for class container ?>

<pre>
<div id="log_debug_div" style="position: fixed; top: 100px; right: 5px; border: 2px red solid; display: block; width: 350px; min-height: 150px; background-color: #FCF; padding: 5px; overflow: auto; z-index: 9999;"></div>
</pre>

<script>
$( function() {
$( "#log_debug_div" ).draggable();
$( "#log_debug_div" ).resizable();
} );
</script>

</body>
</html>
