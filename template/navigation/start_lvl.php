<?php
$indent = str_repeat("\t", $depth);
if($depth > 1 ) return null;
?>

<div class="<?php echo $this->start_lvl_class; ?>">
    <?php if($depth == 0): ?>
        <div class="absolute left-0 top-full flex justify-center z-50">
            <div data-state="closed" id="submenu" data-depth="<?php echo $depth; ?>" data-orientation="horizontal" class="data-[state=closed]:hidden origin-top-center relative mt-1.5 h-full no-scrollbar w-screen max-w-[250px] rounded-md border bg-popover text-popover-foreground shadow-lg data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-90">
                <div class="left-0 top-0 w-full data-[motion^=from-]:animate-in data-[motion^=to-]:animate-out data-[motion^=from-]:fade-in data-[motion^=to-]:fade-out data-[motion=from-end]:slide-in-from-right-52 data-[motion=from-start]:slide-in-from-left-52 data-[motion=to-end]:slide-out-to-right-52 data-[motion=to-start]:slide-out-to-left-52" dir="ltr">
                    <ul class="grid gap-3 p-3 w-full">
    <?php else: ?>
        <div class="absolute left-60 -top-10 flex justify-center z-50">
            <div data-state="closed" id="submenu" data-depth="<?php echo $depth; ?>" data-orientation="horizontal" class="data-[state=closed]:hidden origin-top-center relative mt-1.5 h-full no-scrollbar w-screen max-w-[250px] rounded-md border bg-popover text-popover-foreground shadow-lg data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-90">
                <div class="left-0 top-0 w-full data-[motion^=from-]:animate-in data-[motion^=to-]:animate-out data-[motion^=from-]:fade-in data-[motion^=to-]:fade-out data-[motion=from-end]:slide-in-from-right-52 data-[motion=from-start]:slide-in-from-left-52 data-[motion=to-end]:slide-out-to-right-52 data-[motion=to-start]:slide-out-to-left-52" dir="ltr">
                    <ul class="grid gap-3 p-3 w-full">
    <?php endif; ?>



