import './bootstrap'
import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import * as Turbo from "@hotwired/turbo"

Turbo.start()
// Turbo.setProgressBarDelay(0)

window.Alpine = Alpine

Alpine.plugin(focus)
Alpine.start()
