<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component! My message is: {{ message }}
                        <input
                            type="text"
                            name="message"
                            id="message"
                            class="form-control"
                            v-model="message"
                        />
                        <small class="form-text text-muted"
                            >Notice the v-bind magic</small
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            message: "Hello Vue!",
        };
    },

    mounted() {
        console.log("Component mounted.");
        console.log(this.message);
    },
};
</script>
