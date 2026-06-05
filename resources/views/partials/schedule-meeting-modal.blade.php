<style>
body.schedule-meeting-modal-open {
    overflow: hidden;
}

.schedule-meeting-modal {
    align-items: center;
    background: rgba(0, 0, 0, 0.72);
    display: none;
    height: 100%;
    justify-content: center;
    left: 0;
    padding: 20px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999999;
}

.schedule-meeting-modal.is-visible {
    display: flex;
}

.schedule-meeting-modal-card {
    background: linear-gradient(145deg, #080808 0%, #202020 100%);
    border: 1px solid #c2a46d;
    box-shadow: 0 24px 70px rgba(0, 0, 0, 0.45);
    color: #fff;
    max-width: 430px;
    padding: 34px 28px 30px;
    position: relative;
    text-align: center;
    width: 100%;
}

.schedule-meeting-modal-close {
    background: transparent;
    border: 0;
    color: #c2a46d;
    cursor: pointer;
    font-size: 30px;
    line-height: 1;
    padding: 0;
    position: absolute;
    right: 16px;
    top: 12px;
}

.schedule-meeting-modal-close:hover,
.schedule-meeting-modal-close:focus {
    background: transparent;
    color: #fff;
    outline: none;
}

.schedule-meeting-modal-logo {
    display: block;
    margin: 0 auto 20px;
    max-width: 150px;
}

.schedule-meeting-modal-eyebrow {
    color: #c2a46d;
    display: block;
    font-family: 'Gotham-Bold', Arial, sans-serif;
    font-size: 12px;
    letter-spacing: 2px;
    margin-bottom: 12px;
    text-transform: uppercase;
}

.schedule-meeting-modal-title {
    color: #fff;
    font-size: 28px;
    line-height: 1.25;
    margin: 0 0 14px;
}

.schedule-meeting-modal-action {
    background: #c2a46d;
    border: 1px solid #c2a46d;
    color: #000;
    cursor: pointer;
    display: inline-block;
    font-family: 'Gotham-Bold', Arial, sans-serif;
    font-size: 13px;
    letter-spacing: 1px;
    padding: 13px 24px;
    text-transform: uppercase;
}

.schedule-meeting-modal-action:hover,
.schedule-meeting-modal-action:focus {
    background: transparent;
    color: #c2a46d;
    text-decoration: none;
}
</style>

<div id="schedule-meeting-modal" class="schedule-meeting-modal" aria-hidden="true">
    <div class="schedule-meeting-modal-card" role="dialog" aria-modal="true" aria-labelledby="schedule-meeting-modal-title">
        <button type="button" class="schedule-meeting-modal-close" aria-label="Close">&times;</button>
        <img class="schedule-meeting-modal-logo" src="{{ asset('asset/wp-content/themes/twentytwenty-child/assets/images/logo.png') }}" alt="AIX Investment Group Logo">
        <span class="schedule-meeting-modal-eyebrow">AIX Investment Group</span>
        <h3 id="schedule-meeting-modal-title" class="schedule-meeting-modal-title">Message our live support now!</h3>
        <button type="button" class="schedule-meeting-modal-action">Got it</button>
    </div>
</div>

<script>
(function () {
    function openScheduleMeetingModal() {
        var modal = document.getElementById('schedule-meeting-modal');
        if (!modal) {
            return;
        }

        modal.classList.add('is-visible');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('schedule-meeting-modal-open');

        var closeButton = modal.querySelector('.schedule-meeting-modal-close');
        if (closeButton) {
            closeButton.focus();
        }
    }

    function closeScheduleMeetingModal() {
        var modal = document.getElementById('schedule-meeting-modal');
        if (!modal) {
            return;
        }

        modal.classList.remove('is-visible');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('schedule-meeting-modal-open');
    }

    document.addEventListener('click', function (event) {
        var trigger = event.target.closest('.schedule-meeting-alert, .sech-meeting-mobile, .schedule-a-meeting-btn, a[href*="contact-form-main"]');

        if (trigger) {
            event.preventDefault();
            openScheduleMeetingModal();
            return;
        }

        if (
            event.target.classList.contains('schedule-meeting-modal-close') ||
            event.target.classList.contains('schedule-meeting-modal-action') ||
            event.target.id === 'schedule-meeting-modal'
        ) {
            closeScheduleMeetingModal();
        }
    });

    document.addEventListener('keyup', function (event) {
        if (event.key === 'Escape' || event.keyCode === 27) {
            closeScheduleMeetingModal();
        }
    });
})();
</script>
