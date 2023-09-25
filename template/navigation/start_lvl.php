<?php
$indent = str_repeat("\t", $depth);

// $output .= "\n$indent <div class=\"$this->start_lvl_class\">\n";

// $output .= "\n$indent <div class=\"relative \"> \n";
// $output .= "\n$indent <div class=\"rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden\"> \n";
// $output .= "\n$indent <div class=\"relative grid gap-6 bg-white px-2 py-3 sm:gap-8 sm:p-8\"> \n";

?>


<div class="<?php echo $this->start_lvl_class; ?>">
    <div class="absolute left-0 top-full flex justify-center z-50">
        <div data-state="open" data-orientation="horizontal" class="origin-top-center relative mt-1.5 h-screen max-h-56 w-screen max-w-xs overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-lg data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-90">
            <div class="left-0 top-0 w-full data-[motion^=from-]:animate-in data-[motion^=to-]:animate-out data-[motion^=from-]:fade-in data-[motion^=to-]:fade-out data-[motion=from-end]:slide-in-from-right-52 data-[motion=from-start]:slide-in-from-left-52 data-[motion=to-end]:slide-out-to-right-52 data-[motion=to-start]:slide-out-to-left-52 md:absolute md:w-auto" dir="ltr">
                <ul class="grid gap-3 p-3 pb-1 w-[400px] md:w-[450px] lg:w-[480px] xl:w-[500px] md:grid-cols-2 lg:grid-cols-[.75fr_1fr]">


