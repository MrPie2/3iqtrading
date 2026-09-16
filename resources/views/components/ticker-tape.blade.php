<style>
.iq-market-ticker {
    height: 58px;
    display: flex;
    align-items: center;

    background: #ffffff;
    border-top: 1px solid #e5eaf2;
    border-bottom: 1px solid #e5eaf2;

    overflow: hidden;
}

.iq-live {
    flex: 0 0 auto;

    height: 100%;
    padding: 0 22px;

    display: flex;
    align-items: center;
    gap: 8px;

    background: #f5f8ff;

    color: #172554;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;

    z-index: 2;
}

.iq-live-dot {
    width: 7px;
    height: 7px;

    background: #2563eb;
    border-radius: 50%;

    animation: iqPulse 1.5s infinite;
}

@keyframes iqPulse {

    0% {
        opacity: 1;
    }

    50% {
        opacity: .35;
    }

    100% {
        opacity: 1;
    }

}

.iq-ticker-window {
    overflow: hidden;
    width: 100%;
}

.iq-ticker-track {
    display: flex;
    width: max-content;

    animation: iqScroll 35s linear infinite;
}

.iq-stock {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 0 28px;

    height: 58px;

    border-right: 1px solid #edf0f5;

    white-space: nowrap;
}

.iq-stock strong {
    color: #172554;
    font-size: 13px;
}

.iq-price {
    color: #374151;
    font-size: 13px;
}

.iq-change {
    font-size: 12px;
    font-weight: 600;
}

.iq-change.up {
    color: #16a34a;
}

.iq-change.down {
    color: #dc2626;
}

@keyframes iqScroll {

    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-50%);
    }

}

.iq-market-ticker:hover .iq-ticker-track {
    animation-play-state: paused;
}

@media(max-width: 576px) {

    .iq-live {
        padding: 0 12px;
        font-size: 9px;
    }

    .iq-stock {
        padding: 0 18px;
    }

}
</style>
<div class="iq-market-ticker">

    <div class="iq-live">
        <span class="iq-live-dot"></span>
        LIVE MARKETS
    </div>

    <div class="iq-ticker-window">
        <div id="iqTicker" class="iq-ticker-track">hhhhh</div>
    </div>

</div>



