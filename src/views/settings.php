<div class="card" style="height: 100%;">
    <div class="col-xs-3 stngs-menu">
        <a href="/settings/general">
            <div class="stngs-menu-item<?=isset($data['active']['general']) ? $data['active']['general'] : NULL?>">
                <i class="fa fa-cogs" style="color: darkslategray">&nbsp</i> General
            </div>
        </a>
        <a href="/settings/privacy">
            <div class="stngs-menu-item<?=isset($data['active']['privacy']) ? $data['active']['privacy'] : NULL?>">
                <i class="fa fa-lock" style="color: darkslategray">&nbsp</i> Privacy
            </div>
        </a>
        <a href="/settings/security">
            <div class="stngs-menu-item<?=isset($data['active']['security']) ? $data['active']['security'] : NULL?>">
            <i class="fa fa-shield" style="color: darkslategray">&nbsp</i> Security
            </div>
        </a>
        <a href="/settings/notifications">
            <div class="stngs-menu-item<?=isset($data['active']['notifications']) ? $data['active']['notifications'] : NULL?>">
            <i class="fa fa-bell" style="color: darkslategray">&nbsp</i> Notifications
            </div>
        </a>
    </div>
    <?=Core::loadView('-1-', $data)?>
</div>