<template>
    <div>
        <nav class="nav row border-bottom border-black">
            <div class="d-flex mb-5">
                <router-link class="nav-link pb-1 active" to="/">
                    <h5>Open</h5>
                </router-link>
                <router-link class="nav-link pb-1" to="/completed">
                    <h5>Completed</h5>
                </router-link>
                <div class="ms-auto row">
                    <div class="col-md-6 text-end">
                        <form action="" method="get">
                            <button type="button" class="btn btn-secondary">
                                <i
                                    class="fa fa-search text-info"
                                    aria-hidden="true"
                                ></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6" style="margin-left: -25px">
                        <a href="#" class="btn btn-secondary" target="_blank"
                            ><i
                                class="fa fa-file-excel-o text-info"
                                aria-hidden="true"
                            ></i
                            ><span class="text-muted fw-bold"> Export</span></a
                        >
                    </div>
                </div>
            </div>
        </nav>
        <create-button />
    </div>
</template>

<script>
export default {
    props: {
        setActive: {
            type: String,
            default: "open",
        },
    },
    mounted() {
        // Pengkondisian tab yang aktif
        if (this.setActive == "open") {
            document
                .querySelector(".nav-link.active")
                .classList.remove("active");
            document
                .querySelector(".nav-link:nth-child(1)")
                .classList.add("active");
        } else if (this.setActive == "completed") {
            document
                .querySelector(".nav-link.active")
                .classList.remove("active");
            document
                .querySelector(".nav-link:nth-child(2)")
                .classList.add("active");
        }
    },
};
</script>

<style></style>
