import './bootstrap'
import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import * as Turbo from "@hotwired/turbo"

Turbo.start()
// Turbo.setProgressBarDelay(0)

window.Alpine = Alpine
window.Turbo = Turbo

Alpine.plugin(focus)
Alpine.start()
