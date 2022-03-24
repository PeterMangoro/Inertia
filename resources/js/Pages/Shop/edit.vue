<template>
    <jet-form-section @submitted="updateProductInformation">
        <template #title>
            Product Information
        </template>

        <template #description>
            Create your Product here.
        </template>

        <template #form>
            <!-- Product Photo -->
            <div class="col-span-6 sm:col-span-4" >
                <!-- Product Photo File Input -->
                <input type="file" class="hidden"
                            ref="image"
                            @change="updatePhotoPreview">

                <jet-label for="image" value="Image" />

                <!-- Current Product Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="product.image" :alt="product.title" class="object-cover w-20 h-20 rounded-full">
                </div>

                <!-- New Product Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                          :style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.prevent="deletePhoto" v-if="product.image">
                    Remove Photo
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="title" value="Title" />
                <jet-input id="title" type="text" class="block w-full mt-1" v-model="form.title" autocomplete="title" />
                <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>

            <!-- Price -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="price" value="Price" />
                <jet-input id="price" type="text" class="block w-full mt-1" v-model="form.price" />
                <jet-input-error :message="form.errors.price" class="mt-2" />
            </div>

            <!-- Detail -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="detail" value="Detail" />
                <jet-input id="detail" type="text" class="block w-full mt-1" v-model="form.detail" />
                <jet-input-error :message="form.errors.detail" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['product'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    title: this.product.title,
                    price: this.product.price,
                    detail: this.product.detail,
                    image: null,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProductInformation() {
                if (this.$refs.image) {
                    this.form.image = this.$refs.image.files[0]
                }

                this.form.post(route('products.update'), {
                    errorBag: 'updateProductInformation',
                    preserveScroll: true,
                    onSuccess: () => (this.clearPhotoFileInput()),
                });
            },

            selectNewPhoto() {
                this.$refs.image.click();
            },

            updatePhotoPreview() {
                const image = this.$refs.image.files[0];

                if (! image) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(image);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-product-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.photoPreview = null;
                        this.clearPhotoFileInput();
                    },
                });
            },

            clearPhotoFileInput() {
                if (this.$refs.image?.value) {
                    this.$refs.image.value = null;
                }
            },
        },
    })
</script>
