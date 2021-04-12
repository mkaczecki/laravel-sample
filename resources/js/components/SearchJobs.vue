<template>
    <input v-model="search" class="rounded-pill px-4 py-2 col-3 text-center" type="text" placeholder="Find your imagine job..."
       style="font-weight: 700; font-size: 0.98rem; color: #1C1C1C; background-color: #EAEAEA; border: none; outline: none;" @keyup="this.filterJobs">
</template>

<script>
    export default {
        mounted() {
            //
        },

        methods: {
            filterJobs(){
               axios.post('/jobs/search', {
                   title: this.search,
               })
                .then(response => {
                    this.jobs = response.data;
                    alert(JSON.stringify(this.jobs, null, 4));
                });
            }
        },

        data: function(){
            return {
                jobs: [],
            }
        }

    }
</script>
