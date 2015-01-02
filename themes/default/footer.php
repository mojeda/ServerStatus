      <div class="footer">
        <div><a href="https://github.com/mojeda/ServerStatus">ServerStatus 3.0 BETA</a> by <a href="http://www.mojeda.com">Michael Ojeda</a></div>
        <div><?php if(isset($refresh)) { echo "<span style='font-size: 9px; color: #666;'>Auto Refresh Every ".$refresh * 0.001." Seconds</span>"; }; ?></div>
      </div>

    </div>

    <?php if(isset($js)) { echo $js; } ?>

  </body>
</html>