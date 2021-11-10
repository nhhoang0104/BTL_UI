<template>
  <div>
    <div class="cus-radio-group">
      <div class="header">Tạo dữ liệu cho hệ thống showoff:</div>
      <div class="label">Chọn loại:</div>
      <DxRadioGroup
        :items="dataSrcRadio"
        v-model:value="mode"
        value-expr="value"
        display-expr="label"
        layout="horizontal"
      />
    </div>
    <div class="container">
      <div class="file-uploader-block" v-show="!mode">
        <div>Tải dữ liệu hệ thống đã có:</div>
        <DxFileUploader
          select-button-text="Tải file"
          label-text="Chỉ cho phép file: *.json, *.trealet."
          :allowed-file-extensions="['.json', '.trealet']"
          upload-mode="useForm"
          @value-changed="readFileJson"
        />
      </div>
      <div
        class="list"
        v-if="dataForm && dataForm.trealet && dataForm.trealet.items"
      >
        <div>Danh sách các loại tranh:</div>
        <br />
        <div v-for="(item, index) in dataForm.trealet.items" :key="index">
          <div class="flex flex-v-center flex-gap-10">
            <div>&nbsp;&nbsp;&nbsp; {{ index + 1 }}. {{ item.title }}:</div>
            <DxButton
              :width="100"
              text="Sửa"
              type="normal"
              styling-mode="outlined"
              @click="updateItem(index)"
            />
            <DxButton
              :width="100"
              text="Xóa"
              type="normal"
              styling-mode="outlined"
              @click="removeItem(index)"
            />
          </div>
          <br />
        </div>
      </div>
      <div class="tool">
        <div class="add">
          <div class="title">Thêm mới loại tranh:</div>

          <DxButton
            :width="100"
            text="Thêm"
            type="normal"
            styling-mode="outlined"
            @click="addItem"
          />
        </div>

        <DxButton
          :width="200"
          text="Xuất file dữ liệu"
          type="normal"
          styling-mode="outlined"
          @click="exportFile"
        />
      </div>
    </div>

    <FormData
      :isShowed="isShowForm"
      :dataSrc="categorySelected"
      :indexItem="indexCategorySelected"
      @close="closeFormData"
      @save="addNewCategory"
    />
  </div>
</template>

<script>
import FormData from "@/views/FormData.vue";
import { DxFileUploader } from "devextreme-vue/file-uploader";
import DxButton from "devextreme-vue/button";
import DxRadioGroup from "devextreme-vue/radio-group";
import _ from "lodash";

export default {
  components: {
    FormData,
    DxFileUploader,
    DxButton,
    DxRadioGroup,
  },

  data() {
    return {
      isShowForm: false,
      dataSrcRadio: [
        { label: "Thêm dữ liệu", value: 0 },
        { label: "Tạo mới dữ liệu", value: 1 },
      ],
      modelForm: {
        trealet: {
          exec: "streamline",
          items: [],
        },
      },
      dataForm: null,
      categorySelected: null,
      indexCategorySelected: -1,
      mode: 0,
      labelBtn: "Thêm",
    };
  },

  watch: {
    mode(newVal) {
      if (newVal === 1) {
        this.dataForm = _.cloneDeep(this.modelForm);
      }
    },
  },

  methods: {
    // mở form
    openFormData() {
      this.isShowForm = true;
    },

    // đóng form
    closeFormData() {
      this.isShowForm = false;
    },

    // thêm category
    addNewCategory(category = null, index) {
      this.isShowForm = false;
      if (category === null) return;

      if (this.dataForm) {
        if (index === -1) {
          this.dataForm.trealet.items.push(category);
          return;
        } else {
          this.dataForm.trealet.items[index] = _.cloneDeep(category);
        }
      }
    },

    // xử lý đọc file
    readFileJson({ value }) {
      let me = this;
      if (value && value[0]) {
        let file = value[0];
        let fr = new FileReader();

        fr.onload = function(e) {
          try {
            let temp = JSON.parse(e.target.result);
            if (temp && temp.trealet) me.dataForm = JSON.parse(e.target.result);
          } catch (error) {
            this.dataForm = _.cloneDeep(this.modelForm);
            console.log(error);
          }
        };

        fr.readAsText(file);
      }
    },

    // xuất file
    exportFile() {
      let data = null;

      if (!this.dataForm) {
        data = JSON.stringify(this.modelForm);
      } else {
        data = JSON.stringify(this.dataForm);
      }

      const blob = new Blob([data], { type: "application/json" });

      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = "dataSrc.trealet";
      link.click();
      URL.revokeObjectURL(link.href);
    },

    /**
     * add
     */
    addItem() {
      this.categorySelected = null;
      this.indexCategorySelected = -1;
      this.openFormData();
    },

    /**
     * update item
     * @params index
     * @returns
     */
    updateItem(index) {
      this.categorySelected = _.cloneDeep(this.dataForm.trealet.items[index]);
      this.indexCategorySelected = index;
      this.openFormData();
    },

    /**
     * remove item
     */
    removeItem(index) {
      if (index > -1) {
        this.dataForm.trealet.items.splice(index, 1);
      }
    },
  },
};
</script>

<style lang="scss">
.cus-radio-group {
  margin: 20px;

  .header {
    padding: 10px 0px;
    font-weight: bold;
    font-size: 36px;
  }

  .label {
    padding: 10px 0px;
    font-weight: bold;
  }
}

.container {
  margin-left: 20px;
  .dx-fileuploader-wrapper {
    padding: 7px 0px;
  }

  .tool {
    display: flex;
    flex-direction: column;
    gap: 10px;
    .add {
      display: flex;
      align-items: center;
      gap: 10px;
      height: 50px;

      .title {
        font-weight: bold;
        margin: 20px 0px;
      }
    }
  }
}

.flex {
  display: flex !important;
}

.flex-v-center {
  align-items: center;
}

.flex-gap-10 {
  gap: 10px;
}
</style>
