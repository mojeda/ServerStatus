      <div class="footer">
        <div><a href="https://github.com/mojeda/ServerStatus">ServerStatus 3.0 BETA</a> by <a href="http://www.mojeda.com">Michael Ojeda</a></div>
        <div><?php if(isset($refresh)) { echo "<span style='font-size: 9px; color: #666;'>Auto Refresh Every ".$refresh * 0.001." Seconds</span>"; }; ?></div>
      </div>

    </div>

    <?php if(isset($js)) { echo $js; } ?>

    <script>
    $('i.tip').tooltip({
    	'selector' : '',
    	'placement' : 'bottom'
    });
    </script>

    <!-- Piwik -->
	<script type="text/javascript">
	  var _paq = _paq || [];
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
	    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://apps.mojeda.net/analytics/";
	    _paq.push(['setTrackerUrl', u+'piwik.php']);
	    _paq.push(['setSiteId', 3]);
	    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
	    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
	<noscript><p><img src="http://apps.mojeda.net/analytics/piwik.php?idsite=3" style="border:0;" alt="" /></p></noscript>
	<!-- End Piwik Code -->

	<script type="text/javascript">
		window.setTimeout(function(){ document.location.reload(); }, <?php echo $refresh; ?>);
	</script>

  </body>
</html>