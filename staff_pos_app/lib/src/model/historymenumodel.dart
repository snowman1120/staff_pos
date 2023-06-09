class HistoryMenuModel {
  final String menuTitle;
  final String quantity;
  final String menuPrice;

  const HistoryMenuModel({
    required this.menuTitle,
    required this.quantity,
    required this.menuPrice,
  });

  factory HistoryMenuModel.fromJson(Map<String, dynamic> json) {
    return HistoryMenuModel(
      menuTitle: json['menu_title'],
      quantity: json['quantity'].toString(),
      menuPrice: double.parse(json['menu_price']).toInt().toString(),
    );
  }
}
