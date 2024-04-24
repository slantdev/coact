<?php
// Force enable SearchWP's alternate indexer.
add_filter('searchwp\indexer\alternate', '__return_true');
