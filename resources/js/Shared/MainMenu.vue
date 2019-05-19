<template>
    <div>
        <div class="mb-4">
            <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
                <icon name="dashboard" class="w-4 h-4 mr-2" :class="isPath('dashboard') ? 'fill-white' : 'fill-blue-300 group-hover:fill-white'" />
                <div :class="isPath('dashboard') ? 'text-white' : 'text-blue-200 group-hover:text-white'">Dashboard</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon';
import ParsesUrls from 'Mixins/ParsesUrls';

export default {
    components: {
        Icon,
    },
    mixins: [ ParsesUrls ],
}
</script>
